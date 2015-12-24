<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

    protected $fillable =
        [
            'id',
            'user_id',
            'customer_id',
            'order_status_id',
            'sync_id'
        ];
    //
    public function lineItems()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public static function todaysOrders()
    {
        return count(self::where('created_at', '>' ,date('Y-m-d'))->get());
    }

    public static function salesByDate($startDate = '2015-01-01',$endDate =  '2015-12-12')
    {
        return self::whereBetween('created_at' ,[$startDate,$endDate])->get();
    }

    public static function getTopCustomers($number = 10)
    {
        return self::select('customer_id',DB::raw('count(customer_id) as orders_count'))
                    ->groupBy('customer_id')
                    ->orderBy('orders_count','desc')
                    ->get();
        }

}
