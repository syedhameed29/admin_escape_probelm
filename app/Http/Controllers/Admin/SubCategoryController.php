<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SubCategory;
use App\Model\Service;
use App\Model\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $sub=SubCategory::all();
        $category=Category::all();
        return view('admin.subcategory',compact('sub','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code=SubCategory::latest()->pluck('code')->first();
        $sub=new SubCategory;
        if (isset($code)) {
            // Sum 1 + last id
                    $sub->code        = ++$code;
                } else {
                    $sub->code        = 'EPSC000';
                }
        $sub->category_id=$request->category_id;
        $sub->name=$request->name;
        $sub->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub=SubCategory::all();
        $service=Service::where('sub_id',$id)->get();
        return view('admin.service',compact('service','sub'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sub=SubCategory::find($id);
        $sub->category_id=$request->category_id;
        $sub->name=$request->name;
        $sub->save();
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub=SubCategory::find($id);
        $sub->delete();
        return redirect()->back();
    }
}