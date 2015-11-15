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
}
