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
        "sales_rep",
        "status",
        "sync_status"
    ];

    /*public function __construct($order_id)
    {
        parent::__construct();

        $this->setAttribute("order_id",$order_id);

    }*/

}
