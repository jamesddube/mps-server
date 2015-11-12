<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwOrdersModel extends Model
{
    //

    protected $table = "vw_orders";

    protected $primaryKey = "order_id";

    protected $fillable = [

        "order_id",
        "customer_id",
        "sales_rep",
        "order_status",
        "sync_status",
        "status"
    ];

    public function lineItems()
    {
        return $this->hasMany('App\vwOrderDetailsModel','order_id');
    }
}
