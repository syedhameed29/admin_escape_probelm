<?php

namespace App\Http\Controllers\Customer;

use App\Notifications\ManagerNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Service; 
use App\Model\District;
use App\Model\Appointment;
use App\Model\CustomerAddress;
use App\Model\Manager;
use Auth;
use Validator;

class AddressController extends Controller
{
    public function showAddress($id)
    {
        $address = CustomerAddress::find($id);
        return response( array("Address" => $address));   

    }
    public function create(Request $request)
    {
    	// validate input fields
    	 $validator = Validator::make($request->all(), [
            'mobile' => 'required','address' => 'required',
            'district' => 'required','state' => 'required','country' => 'required',
        ]);
    	if ($validator->passes())
        {
    	$code=CustomerAddress::latest()->pluck('code')->first();
        $address=new CustomerAddress;
        if (isset($code)) {
            	$address->code        = ++$code;
            } else {
               	$address->code        = 'EPCA00';
            }
        $address->customer_id=Auth::user()->id;
        $address->mobile = $request->mobile;
        $address->address = $request->address;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->save();
        return response( array( "message" => "Address Added Successfully", "data" => ["Addresses" => $address]));   
        }
        return response()->json(['error'=>$validator->errors()->all()]);         
    }
    public function editAddress(Request $request)
    {
        // validate input fields
    	 $validator = Validator::make($request->all(), [
            'mobile' => 'required','address' => 'required',
            'district' => 'required','state' => 'required','country' => 'required',
        ]);
    	if ($validator->passes())
        {
    	
        $address = CustomerAddress::find($request->address_id);
        $address->mobile = $request->mobile;
        $address->address = $request->address;
        $address->district = $request->district;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->save();
        return response( array( "message" => "Address Edited Successfully", "data" => ["Addresses" => $address]));   
        }
        return response()->json(['error'=>$validator->errors()->all()]);                
    }
    // public function allappointment()
    // {
    //     $appointment=Appointment::with('Partner','Service')->where('customer_id',Auth::user()->id)->get();
    //     return response( array( "message" => "Appointments...","Data"=>$appointment));                 
    // }
    public function deleteAddress(Request $request)
    {
        $address=CustomerAddress::find($request->address_id);
        $address->delete();
        return response( array( "message" => "Address deleted"));                 
    }
}