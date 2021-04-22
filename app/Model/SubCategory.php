<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_categories';
    public function category()
    {
        return $this->belongsTo('App\Model\Category','category_id');
    }
    public function service()
    {
        return $this->hasMany('App\Model\Service','sub_id');
    }

}