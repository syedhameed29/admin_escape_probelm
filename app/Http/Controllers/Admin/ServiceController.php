<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Service;
use App\Model\SubCategory;

class ServiceController extends Controller
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
        $service=Service::all();
        return view('admin.service',compact('service','sub'));
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
        $code=Service::latest()->pluck('code')->first();
        $service=new Service;
        if (isset($code)) {
            // Sum 1 + last id
                    $service->code        = ++$code;
                } else {
                    $service->code        = 'EPSE000';
                }
        $service->sub_id=$request->sub_id;
        $service->name=$request->name;
        if($request->image!='')
        $service->image=base64_encode(file_get_contents($request->file('image')));
        else
        $service->image=base64_encode(file_get_contents('admin/img/default.png'));
        $service->amount=$request->amount;
        $service->description=$request->description;
        $service->save();
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
        //
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
        $service=Service::find($id);
        $service->sub_id=$request->sub_id;
        $service->name=$request->name;
        if($request->image!='')
         $service->image=base64_encode(file_get_contents($request->file('image')));
        else
        $service->image=$service->image;
        $service->amount=$request->amount;
        $service->description=$request->description;
        $service->save();
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
        $service=Service::find($id);
        $service->delete();
        return redirect()->back();
    }
}