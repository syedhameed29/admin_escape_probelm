<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use App\Notifications\PartnerResetPassword;
use App\Model\category;

class Partner extends Authenticatable
{
    use HasApiTokens, Notifiable;  
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PartnerResetPassword($token));
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function appointment()
    {
        return $this->hasMany('App\Model\Appointment');
    }
    public function wallet()
    {
        return $this->hasOne('App\Model\Wallet');
    }
}   