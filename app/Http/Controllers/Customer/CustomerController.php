<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Customer;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth; 
use App\Model\Country;
class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required|numeric|min:10',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ]);
        if ($validator->passes())
        {
            $code=Customer::latest()->pluck('code')->first();
            $customer=new Customer;
            if (isset($code)) {
                    $customer->code        = ++$code;
                } else {
                    $customer->code        = 'EPCR000';
                }
            $customer->name=$request->name;
            $customer->email=$request->email;
            $customer->mobile=$request->mobile;
            $customer->password = Hash::make($request->password);
            $customer->terms=$request->terms;
            $customer->save();
            return response( 
               // array( "message" => "Successfully Registered..", "data" => [
               // "customer" => $customer,            
                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
               [ "token" => $customer->createToken('Personal Access Token',['customer'])->accessToken]
             , 200 );
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
        if(Customer::where('email',$email)->count() <= 0 ) return response( array( "error" => "Email does not exist"  ) );
        $customer = Customer::where('email',$email)->first();
        if(password_verify($password,$customer->password)){
           $customer->updated_at = Carbon::now();
            $customer->save();
            return response( array( "message" => "Sign In Successful", "data" => [
                "customer" => $customer,               
                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $customer->createToken('Personal Access Token',['customer'])->accessToken
            ]  ), 200 );
        } else {
            return response( array( "error" => "Wrong Credentials." ), 200 );
        }
    }   
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response( array( "message" => "Logout Success..." ));
    } 
    public function profile()
    {
        $customer=Customer::with('cusaddress')->where('id',Auth::user()->id)->first();
        return response( array( "CustomerProfile" => $customer ));
    }
    public function editprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|min:10',
        ]);
        if ($validator->passes())
        {
            $customer=Customer::find(Auth::user()->id);
            $customer->mobile=$request->mobile;
            $customer->save();
            return response( array( "Message" => "Details Updated" ));
        }
        return response()->json(['error'=>$validator->errors()->all()]); 
    }
    public function country()
    {
        $country=Country::with('State.District')->get();
        return response( array( "Countries" => $country ));
    }
}