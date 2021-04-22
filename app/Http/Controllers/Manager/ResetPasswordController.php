<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use App\Model\Manager;


class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:manager'); 
    }
    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }
        $manager=Manager::where('email',request()->email)->first();
        return response( array( "message" => "Password Changed Successfully..", "data" => [
            "manager" => $manager,"token" => $manager->createToken('Personal Access Token',['manager'])
                ->accessToken]  ), 200 );
    }
    public function broker()
    {
        return Password::broker('manager');
    }  
}