<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use App\Notifications\CustomerResetPassword;
 

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable; 
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token));
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function appointment()
    {
        return $this->hasMany('App\Model\Appointment','customer_id');
    }    
    public function cusaddress()
    {
        return $this->hasMany('App\Model\CustomerAddress');
    }
}