<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function sub()
    {
        return $this->hasMany('App\Model\SubCategory');
    }
    public function district()
    {
        return $this->belongsToMany(District::class,'district_categories');
    }
    public function partner()
    {
        return $this->belongsToMany(Partner::class,'partner_categories');
    }
}