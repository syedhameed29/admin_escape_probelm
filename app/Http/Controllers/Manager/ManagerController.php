<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\Manager;
use Carbon\Carbon;
use Auth;

class ManagerController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $rules = [
            'email' => 'required|email:rfc,dns|max:255',
            'password' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {return  response()->json(["error" => $validator->errors()->first()]);}
        if(Manager::where('email',$email)->count() <= 0 ) return response( array( "error" => "Email does not exist"  ) );
        $manager = Manager::where('email',$email)->first();
        if(password_verify($password,$manager->password)){
           $manager->updated_at = Carbon::now();
            $manager->save();
            return response( array( "message" => "Sign In Successful",                
                "token" => $manager->createToken('Personal Access Token',['manager'])->accessToken
              ), 200 );
        } else {
            return response( array( "error" => "Wrong Credentials." ));
        }
    }   
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response( array( "message" => "Logout Success..." ));
    }
    public function show()
    {
        return response( array( "message" => "manager" ,"Data"=>Auth::user()));
    }
    public function readnotification()
    {
        return response( array( "message" => "Notification..." ,"Data"=>Auth::user()->readNotifications));
    }
    public function unreadnotification()
    {
        return response( array( "message" => "Notification..." ,"Data"=>Auth::user()->unreadNotifications));
    }
    public function markasread($id)
    {
        Auth::user()->notifications->find($id)->markAsRead();
        return response( array( "message" => "Mark the Notification as read...."));
    }
}
 