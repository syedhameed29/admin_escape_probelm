<?php

namespace App\Model;
use App\Model\District;
use App\Model\Partner;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function sub()
    {
        return $this->belongsTo('App\Model\SubCategory','sub_id');
    }
    public function partner()
    {
        return $this->belongsToMany(Partner::class);
    }
    public function appointment()
    {
        return $this->hasMany('App\Model\Appointment');
    }
}