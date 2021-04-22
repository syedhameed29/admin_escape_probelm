<?php

namespace App\Http\Controllers\Partner;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DistrictCategory;
use App\Model\PartnerCategory;
use App\Model\District;
use App\Model\Category;
use Auth;

class CategoryController extends Controller
{
    public function category()
    {
        $district=District::where('district',Auth::user()->district)->first();
        $category=DistrictCategory::with(['category.partner'=>function($q){
            $q->where('partners.id',Auth::user()->id);
        }])->where('district_id',$district->id)->get();
        return response(array('category'=>$category));
    }
    public function selectedcategory()
    {
        $partcat=PartnerCategory::with('category')->where('partner_id',Auth::user()->id)->get();
        return response(array('category'=>$partcat));
    }
    public function addcategory(Request $request)
    {
        $rules = [ 
            'category_id' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {return  response()->json(["error" => $validator->errors()->first()]);}
        $partcat=PartnerCategory::where('partner_id',Auth::user()->id)->get();
        foreach($partcat as $partcat)
        {
            $partcat->delete();
        }
        foreach($request->category_id as $cat_id){
            $partcat= new PartnerCategory;
            $partcat->partner_id=Auth::user()->id;
            $partcat->category_id=$cat_id;
            $partcat->save();
        }
        return response(array("message"=>"Categories saved"));
    }
}