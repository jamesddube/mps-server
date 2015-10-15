<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    //

    protected $table = "orders";

    protected $primaryKey = "order_id";

    protected $fillable = [

        "order_id",
        "customer_id",
        "sales_rep",
        "order_status",
        "sync_status"
    ];


}


