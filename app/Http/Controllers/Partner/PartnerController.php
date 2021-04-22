<?php

namespace App\Http\Controllers\Partner;
use App\Model\Wallet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Partner;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Model\Country;
use App\Model\PartnerCategory;
use App\Model\Category;
use Auth;

class PartnerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:partners',
            'mobile' => 'required|numeric|min:10',
            'address' => 'required|max:255',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
            'aadharno' => 'required|numeric',
            'proofimage' => 'required',
            'terms' => 'required',
            'password' => 'required|string|min:8|confirmed',

        ]);
        if ($validator->passes())
        {
            $code=Partner::latest()->pluck('code')->first();
            $partner=new Partner;
            $partner->name=$request->name;
            if (isset($code)) {
                    $partner->code        = ++$code;
                } else {
                    $partner->code        = 'EPPR000';
                }
            $partner->email=$request->email;
            $partner->mobile=$request->mobile;
            if($request->image != '')
                $partner->image=base64_encode(file_get_contents($request->file('image')));
            else
                $partner->image=$partner->image;
            $partner->address=$request->address;
            $partner->district=$request->district;
            $partner->state=$request->state;
            $partner->country=$request->country;
            $partner->aadharno=$request->aadharno;
            $partner->proofimage=base64_encode(file_get_contents($request->file('proofimage')));
            $partner->terms=$request->terms;
            $partner->password = Hash::make($request->password);
            $partner->save();
            $code=Category::latest()->pluck('code')->first();
            $wallet=new wallet;
            if (isset($code)) {
                        $wallet->code        = ++$code;
                    } else {
                        $wallet->code        = 'EPWA000';
                    }
            $wallet->amount=0;
            $wallet->partner_id=$partner->id;
            $wallet->requestedAmount=0;
            $wallet->save();
            $partcat=PartnerCategory::with('category')->where('partner_id',$partner->id)->get();
            return response( array( "message" => "Successfully Registered..", "data" => [
                "partner" => $partner,  
                "category" => count($partcat),  
                "token" => $partner->createToken('Personal Access Token',['partner'])->accessToken]  ), 200 );
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
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
        if(Partner::where('email',$email)->count() <= 0 ) return response( array( "error" => "Email does not exist"  ) );
        $partner = Partner::where('email',$email)->first();
        if(password_verify($password,$partner->password)){
           $partner->updated_at = Carbon::now();
            $partner->save();
            $partcat=PartnerCategory::with('category')->where('partner_id',$partner->id)->get();
            return response( array( "message" => "Sign In Successful", "data" => [
                "partner" => $partner,
                "category" => count($partcat),              
                "token" => $partner->createToken('Personal Access Token',['partner'])->accessToken
            ]  ), 200 );
        } else {
            return response( array( "error" => "Wrong Credentials." ));
        }
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response( array( "message" => "Logout Success..." ));
    }    
    public function profile()
    {
        $partner=Partner::with('wallet')->where('id',Auth::user()->id)->first();
        return response( array( "profile" => $partner ));
    }
    public function editprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|numeric|min:9',
            'address' => 'required|max:255',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);
        if ($validator->passes())
        {
            $partner=Partner::find(Auth::user()->id);
            $partner->name=$request->name;
            $partner->mobile=$request->mobile;
            if($request->image!='')
                $partner->image=base64_encode(file_get_contents($request->file('image')));
            else
                $partner->image=$partner->image;
            $partner->address=$request->address;  
            $partner->district=$request->district;
            $partner->state=$request->state;
            $partner->country=$request->country;
            $partner->save();
            return response( array( "message" => "Details Updated" ));
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
    public function unreadnotification()
    {
        return response( array( "message" => "Notification..." ,"Data"=>Auth::user()->unreadNotifications));
    }
    public function readnotification()
    {
        return response( array( "message" => "Notification..." ,"Data"=>Auth::user()->readNotifications));
    }
    public function markasread($id)
    {
        Auth::user()->notifications->find($id)->markAsRead();
        return response( array( "message" => "Mark the Notification as read...."));
    }
   
}