<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\District;
use App\Model\Country;

class State extends Model
{
    public function district()
    {
        return $this->hasMany(District::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

}