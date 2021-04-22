<?php

namespace App\Http\Controllers\Manager;
use App\Notifications\PartnerNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\Appointment;
use App\Model\Partner;
use App\Model\Category;
use App\Model\PartnerCategory;
use App\Model\Service;
use App\Model\SubCategory;
use Auth;

class AppointmentController extends Controller
{
    public function index()
    {
    //     $appointment=Appointment::Join('customers','customers.id','appointments.customer_id')
    //     ->Join('customer_addresses','customer_addresses.customer_id','customers.id')
    //     ->select('appointments.*', 'appointments.id', 'appointments.code')
    //    ->with('service')->with('customer')->with('cusaddress')->with('payment')->where('district',Auth::user()->id)
    //     //         ->with(['partner' => function($query) {
    //     //     $query->where('partners.district',Auth::user()->district);
    //     // }])
    //     ->orderBy('appointments.created_at','desc')->get();
        $appointment=Appointment::join('customers','customers.id','appointments.customer_id')
           ->join('customer_addresses','customer_addresses.customer_id','customers.id') ->with('service')->with('customer')->with('cusaddress')->with('payment')->with('partner')->get();
        return response( array( "message" => "Appointments","data"=> $appointment));                 
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'partner_id' => 'required']);
        if ($validator->passes())
        {   
            $appointment=Appointment::find($request->id); 
            $appointment->partner_id=$request->partner_id;
            $appointment->status="allocated";
            $appointment->save();
            Partner::find($request->partner_id)->notify(new PartnerNotification($appointment));
            return response( array( "message" => "Appointment given to the partner..")); 
        }
        return response()->json(['error'=>$validator->errors()->all()]);              
    }
    public function partser($id)
    {
        $service=Service::where('id',$id)->first();
        $sub=SubCategory::where('id',$service->sub_id)->first();
        $category=Category::where('id',$sub->category_id)->first();
        $partser=PartnerCategory::with('partner')->where('category_id',$category->id)->get();
        return response( array( "partser" => $partser)); 
    }
}