<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{
    //
    protected $table = "order_details";

    protected $primaryKey = "order_details_id";

    protected $fillable = [
        "order_details_id",
        "order_id",
        "product_id",
        "quantity",
    ];



}
