<?php

namespace App\Http\Controllers\Customer;

use App\Notifications\ManagerNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Service; 
use App\Model\District;
use App\Model\Appointment;
use App\Model\Manager;
use App\Model\Category;
use App\Model\Partner;
use App\Model\PartnerCategory;
use App\Model\CustomerAddress;
use App\Model\SubCategory;
use Auth;

class AppointmentController extends Controller
{
    
    public function appointment(Request $request)
    {
        $service=Service::where('id',$request->service_id)->first();
        $sub=SubCategory::where('id',$service->sub_id)->first();
        $category=Category::where('id',$sub->category_id)->first();
        $cusaddress=CustomerAddress::find($request->customer_address_id);
        $partcat=PartnerCategory::join('partners','partner_categories.partner_id','partners.id')->select('partners.*','partner_categories.id','partner_categories.*')->where('category_id',$category->id)->where('district',$cusaddress->district)->get();
        if(count($partcat)>0){
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

                $partner= Partner::find($newappoin_id)->first();
                $service=Service::find($request->service_id)->first();
                if($partner->wallet->amount>=($service->amount*10/100))
                {
                $newappoin_id=$partner->id;
                $changenew=Partner::find($newappoin_id);
                $changenew->lastappoint=1;
                $changenew->save();
                $code=Appointment::latest()->pluck('code')->first();
                $appointment=new Appointment;
                if (isset($code)) {
                        $appointment->code        = ++$code;
                } 
                else {
                        $appointment->code        = 'EPAP000';
                }
                $appointment->service_id=$request->service_id;
                $appointment->customer_id=Auth::user()->id;
                $appointment->customer_address_id=$request->customer_address_id;
                $appointment->payment_id=$request->payment_id;
                $appointment->partner_id=$newappoin_id;
                $appointment->status='allocated';
                $appointment->save();
                $manager=Manager::where('district',Auth::user()->district)->get();
                foreach($manager as $manager)
                Manager::find($manager->id)->notify(new ManagerNotification($appointment));
                return response( array( "message" => "Succesfully booked for service...")); 
            }
            }               
            else{
                if($i+1==count($partcat))
                {
                  $newappoin_id=$partcat[0]->partner_id;
                  $partner= Partner::find($newappoin_id)->first();
                  $service=Service::find($request->service_id)->first();

                  if($partner->wallet->amount>=($service->amount*10/100))
                  {
                      $newappoin_id=$partner->id;
                    $changenew=Partner::find($newappoin_id);
                    $changenew->lastappoint=1;
                    $changenew->save();
                    $code=Appointment::latest()->pluck('code')->first(); 
                    $appointment=new Appointment;
                    if (isset($code)) {
                          $appointment->code        = ++$code;
                     } 
                      else {
                              $appointment->code        = 'EPAP000';
                     }

                        $appointment->service_id=$request->service_id;
                        $appointment->customer_id=Auth::user()->id;
                        $appointment->customer_address_id=$request->customer_address_id;
                        $appointment->payment_id=$request->payment_id;
                        $appointment->partner_id=$newappoin_id;
                        $appointment->status='allocated';
                        $appointment->save();
                        $manager=Manager::where('district',Auth::user()->district)->get();
                        foreach($manager as $manager)
                         Manager::find($manager->id)->notify(new ManagerNotification($appointment));
                        return response( array( "message" => "Succesfully booked for service..."));
                    } 
                    else
                     return response(['error'=>'The service you have selected is not available in your area']);

                }
            }  
        }
    }
    else return response(['error'=>'The service you have selected is not available in your area']);
    }
    public function allappointment()
    {
        $appointment=Appointment::with('Partner','Service')->where('customer_id',Auth::user()->id)->get();
        return response( array( "message" => "Appointments","data"=>$appointment));                 
    }
}