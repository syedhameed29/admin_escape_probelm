<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\State;
use App\Model\District;

class AjaxController extends Controller
{
    public function country(Request $request)
    {
        $state = '';
        $country=Country::where('country',$request->country)->first();
        $states=State::where('country_id',$country->id)->get();
        foreach($states as $states)
       {
           $state.='<option value="'.$states->state.'">'.$states->state.'</option>';
       }
       echo json_encode($state);      
    }
    public function state(Request $request)
    {
         $district = '';
        $state=State::where('state',$request->state)->first();
        $districts=District::where('state_id',$state->id)->get();
        foreach($districts as $districts)
       {
           $district.='<option value="'.$districts->district.'">'.$districts->district.'</option>';
       }
       echo json_encode($district);    
    }
}