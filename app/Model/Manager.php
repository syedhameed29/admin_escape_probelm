<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ManagerResetPassword;

class Manager extends Authenticatable 
{
    use HasApiTokens, Notifiable; 
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ManagerResetPassword($token));
    }
    protected $hidden = [ 
        'password', 'remember_token',
    ];
}