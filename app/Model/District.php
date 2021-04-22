<?php

namespace App\Model;
use App\Model\State;
use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function category()
    {
        return $this->belongsToMany(Category::class,'district_categories');
    }

}