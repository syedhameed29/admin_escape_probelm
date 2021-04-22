<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Country;
use App\Model\State;
use App\Model\District;
use App\Model\Service;
use App\Model\DistrictCategory;

class FrontendController extends Controller
{
    public function category($slug)
    {
        $district=District::where('district',$slug)->first();
        $category=DistrictCategory::with('category.sub')->where('district_id',$district->id)->get();
       // $category=Category::with('sub')->get();
      //  return response(["message" => "Categories","data" => ["category" =>$category]]);  
      return response()->json(["message" => "Categories","category" =>$category], 200);
    } 
    public function subcategory($id)
    {
        $sub=SubCategory::with('service')->where('category_id',$id)->get();
        return response()->json( ["message" => "Sub Categories", "data"  => $sub]);           
    }
    public function service($id)
    {
        $service = Service::with('sub.category')->where('sub_id',$id)->get();
        return response( array( "message" => "Services", "data" => ["Services" => $service]));           
    }
    public function selectservice($id)
    {
        $service=Service::find($id);
        return response( array( "message" => "Service", "data" => ["Service" => $service]));           
    }
    public function country()
    {
        $country=Country::with('State.District')->get();
        return response( array( "Countries" => $country ));
    }
    public function selectedstate($slug)
    {
        $country=Country::where('country',$slug)->first();
        $state=State::with('District')->where('country_id',$country->id)->get();
        return response( array( "states" => $state));
    }public function selecteddistrict($slug)
    {
        $state=State::where('state',$slug)->first();
        $district=District::where('state_id',$state->id)->get();
        return response( array( "districts" => $district));
    }
    public function district()
    {
        $district=District::all();
        return response( array( "districts" => $district));
    }
    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required','email' => 'required|email',
            'subject' => 'required','message' => 'required',
        ]);
        if ($validator->passes())
        {
            $contact=new Contact;
            $contact->name=$request->name;
            $contact->email=$request->email;
            $contact->subject=$request->subject;
            $contact->message=$request->message;
            $contact->save();
            return response( array( "message" => 'Contact Saved Successfully'));
        }
        return response()->json(['error'=>$validator->errors()->all()]);                
    }

}