<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwOrder extends Model
{
    //

    protected $table = "vw_orders";

    protected $guarded = [

        "id",
        "customer",
        "sales_rep",
        "order_status",
        "sync_status",
    ];

    public function lineItems()
    {
        return $this->hasMany('App\vwOrderDetail','order_id');
    }

    public static function OrdersByStatus()
    {
        $query =  self::whereBetween('date' ,[self::startDate(),self::endDate()])
            ->where('order_status','draft')->get();

        return $query;
    }

    static function startDate()
    {
        return  date("Y-m-d", strtotime('sunday last week'));
    }


    static function endDate()
    {
        return  date("Y-m-d", strtotime('saturday this week'));
    }
}
