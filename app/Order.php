<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = [

        "id",
        "customer_id",
        "sales_rep",
        "order_status",
        "sync_status",
        "status"
    ];

    public function lineItems()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function todaysOrders()
    {
        return $this->where('created_at','<',date('Y-m-d'));
    }

}


