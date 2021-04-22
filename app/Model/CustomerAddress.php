<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Model\Customer','customer_id');
    }
    public function appointment()
    {
        return $this->hasMany('App\Model\Appointment');
    }
}