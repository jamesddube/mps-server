<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable =
        [
            'id' ,
            'name' ,
            'vat_number' ,
            'address' ,
            'telephone' ,
            'fax' ,
            'email' ,
            'contact_person' ,
            'contact_position' ,
            'contact_cell' ,
            'customer_status_id',
            'customer_type_id'
        ];

        public function orders()
        {
            return $this->hasMany('App\Order');
        }


}
