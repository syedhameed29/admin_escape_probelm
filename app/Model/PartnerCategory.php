<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    public function category()
    {
         return $this->belongsTo(Category::class);
     }
     public function partner()
    {
         return $this->belongsTo(Partner::class);
     }
}