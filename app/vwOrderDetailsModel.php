<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwOrderDetailsModel extends Model
{
    //

    protected $table = "vw_order_details";

    protected $primaryKey = "order_details_id";

    public function order()
    {
        return $this->belongsTo('App\vwOrdersModel','order_id');
    }
}
