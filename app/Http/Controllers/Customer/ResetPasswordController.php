<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function __construct()
    {
        $this->middleware('guest:customer'); 
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
            return response()->json(["error" => "Invalid token provided"]);
        }
        $customer=Customer::where('email',request()->email)->first();
        return response( array( "message" => "Password Changed Successfully..", "data" => [
            "customer" => $customer,"token" => $customer->createToken('Personal Access Token',['customer'])
                ->accessToken]  ), 200 );
            }
            return response()->json(['error'=>$validator->errors()->all()]); 
    }
    public function broker()
    {
        return Password::broker('customer');
    }  
}