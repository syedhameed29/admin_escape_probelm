<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Appointment;
use Auth;
use App\Model\Service;
use App\Model\Category;
use App\Model\Partner;
use App\Model\PartnerCategory;
use App\Model\SubCategory;
use App\Model\CustomerAddress;
use App\Model\Wallet;
class AppointmentController extends Controller
{
    public function index()
    {
        $appointment=Appointment::with('customer')->with('cusaddress')->with('service')->with('payment')->where('partner_id',Auth::user()->id)->get();
        return response( array( "message" => "Appointments", "data" => ["Appointments" => $appointment]));                 
    }
    public function update(Request $request)
    {
        $appointment=Appointment::find($request->id);
        if($request->status=='rejected'){
            $service=Service::where('id',$appointment->service_id)->first();
            $sub=SubCategory::where('id',$service->sub_id)->first();
            $category=Category::where('id',$sub->category_id)->first();
            $cusaddress=CustomerAddress::find($appointment->customer_address_id);
            $partcat=PartnerCategory::join('partners','partner_categories.partner_id','partners.id')->select('partners.*','partner_categories.id','partner_categories.*')->where('category_id',$category->id)->where('district',$cusaddress->district)->get();
            for($i=0;$i<count($partcat);$i++)
            {
                if($partcat[$i]->lastappoint==1){
                    $changelast=Partner::find($partcat[$i]->partner_id);
                    $changelast->lastappoint=0;
                    $changelast->save();
                    if($i+1<count($partcat))
                       $newappoin_id=$partcat[$i+1]->partner_id;
                    else
                       $newappoin_id=$partcat[0]->partner_id;
                    $changenew=Partner::find($newappoin_id);
                    $changenew->lastappoint=1;
                    $changenew->save();
                    $appointment->status=$request->status;
                    $appointment->save();
                    return response( array( "message" => "Succesfully booked for service...")); 
                }               
                else{
                    if($i+1==count($partcat))
                    {
                      $newappoin_id=$partcat[0]->partner_id;
                      $changenew=Partner::find($newappoin_id);
                      $changenew->lastappoint=1;
                      $changenew->save();
                      $code=Appointment::latest()->pluck('code')->first();
                      $appointment->status=$request->status;
                      $appointment->save();
                      return response( array( "message" => "Succesfully booked for service...")); 
                    }
                }  
            }
        }
        else if($request->status=='confirmed')
        {
            $partner=Partner::find($appointment->partner_id)->first();
            $service=Service::find($appointment->service_id)->first();
            $wallet=Wallet::find($partner->wallet->id);
            $wallet->amount=$wallet->amount-($service->amount*10/100);
            $wallet->save();
            $appointment->status=$request->status;
            $appointment->save();
            return response( array( "message" => "Appointment Updated...."));   
        }
        else
        { 
            $appointment->status=$request->status;
            $appointment->save();
            return response( array( "message" => "Appointment Updated...."));   
        }              
    }
}