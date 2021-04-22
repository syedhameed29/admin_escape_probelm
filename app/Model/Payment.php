<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function appointment()
    {
        return $this->hasMany('App\Model\Appointment');
    }
}