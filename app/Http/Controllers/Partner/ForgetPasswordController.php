<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password; 

class ForgetPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function __construct()
    {
        $this->middleware('guest:partner');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        if ($validator->passes())
        {
             $response = $this->broker()->sendResetLink($request->only('email'));
            switch ($response) {
            case Password::RESET_LINK_SENT:
                return response()->json([
                    'success' => true,
                    'message' => 'Mail Sent Successfully..'
                ]);
            case Password::RESET_THROTTLED:
                return response()->json([
                    'success' => false,
                    'message' => 'Try few minutes later'
                ]);
            case Password::INVALID_USER:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid user'
                ]);
            }
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }
    public function broker()
    {
        return Password::broker('partner');
    }  
}