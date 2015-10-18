<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwOrdersModel extends Model
{
    //

    protected $table = "vw_orders";

    protected $primaryKey = "order_id";

    public function lineItems()
    {
        return $this->hasMany('App\vwOrderDetailsModel','order_id');
    }
}
