<?php

namespace App\Http\Controllers\Partner;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use App\Model\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:partner'); 
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8'
        ]);
        if ($validator->passes())
        {
        
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
            return response()->json(["tokenerror" => "Invalid token provided"]);
        }
        $partner=Partner::where('email',request()->email)->first();
        return response( array( "message" => "Password Changed Successfully..", "data" => [
            "partner" => $partner,"token" => $partner->createToken('Personal Access Token',['partner'])
                ->accessToken]  ), 200 );
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }
    public function broker()
    {
        return Password::broker('partner');
    }  
}
 