<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DistrictCategory extends Model
{
    protected $table='district_categories';
    // public function service()
    // {
    //     return $this->belongsTo(Service::class);
    // }
    public function category()
    {
         return $this->belongsTo(Category::class);
     }
}