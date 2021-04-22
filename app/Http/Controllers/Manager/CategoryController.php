<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\District;
use App\Model\DistrictCategory;
use Auth;
class CategoryController extends Controller
{
    public function category()
    {
      $category=Category::with('district')->get();
      return response(array("category"=>$category));   
    }
    public function selectedcategory()
    {
        $district=District::where('district',Auth::user()->district)->first();
        $discat=DistrictCategory::with('category')->where('district_id',$district->id)->get();
        return response(array('category'=>$discat));
    }
    public function editcategory(Request $request)
    {
        $rules = [ 
            'category_id' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {return  response()->json(["error" => $validator->errors()->first()]);}
        $district=District::where('district',Auth::user()->district)->first();
        $discat=DistrictCategory::where('district_id',$district->id)->get();
        foreach($discat as $discat)
        {
            $discat->delete();
        }
        foreach($request->category_id as $cat_id){
            $discat= new DistrictCategory;
            $discat->district_id=$district->id;
            $discat->category_id=$cat_id;
            $discat->save();
        }
        return response(array("message"=>"Categories saved"));
    }
}