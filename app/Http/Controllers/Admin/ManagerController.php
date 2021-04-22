<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\District;
use App\Model\Manager;
use App\Model\Country;

class ManagerController extends Controller
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
        $manager=Manager::all();
        //$country=Country::all();
        $district=District::orderBy('district','asc')->get();
        return view('admin.manager',compact('district','manager','country'));
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
        $request->validate([
            'password'=>'required|confirmed|min:8'
        ]);
        $code=Manager::latest()->pluck('code')->first();
        $manager=new Manager;
        if (isset($code)) {
            // Sum 1 + last id
                    $manager->code        = ++$code;
                } else {
                    $manager->code        = 'EPMA00';
                }
        $manager->name=$request->name;
        $manager->email=$request->email;
        $manager->password=Hash::make($request->password);
        $manager->mobile=$request->mobile;
        $manager->district=$request->district;
        $manager->save();
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
        $manager=Manager::find($id);
        $manager->mobile=$request->mobile;
        $manager->district=$request->district;
        $manager->save();
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
        $manager=Manager::find($id);
        $manager->delete();
        return redirect()->back();
    }
}