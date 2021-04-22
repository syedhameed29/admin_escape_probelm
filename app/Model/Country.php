<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\State;

class Country extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function state()
    {
        return $this->hasMany(State::class);
    }
}