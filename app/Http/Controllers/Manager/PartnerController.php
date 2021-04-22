<?php

namespace App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Partner;
use Auth;
use App\Model\Wallet;

class PartnerController extends Controller
{
    public function index()
    {
        $partner=Partner::with('wallet')->where('district',Auth::user()->district)->get();
        return response( array( "message" => "Partner Datas", "data" => [
            "partner" => $partner])  );           
    }
    public function update(Request $request)
    {
        $rules = [
            'status' => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {return  response()->json(["error" => $validator->errors()->first()]);}
        $partner=Partner::find($request->id);
        $partner->status=$request->status;
        $partner->save();
        return response( array( "message" => "Partner Status Updated..."));           
    }
    public function wallet(Request $request)
    {
        $rules = [
            'status' => ['required'],
            'payment'=>['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {return  response()->json(["error" => $validator->errors()->first()]);}
        $wallet=Wallet::find($request->id);
        $wallet->status=$request->status;
        $wallet->payment=$request->payment;
        if($request->status=='accepted')
        {
            $wallet->amount=$wallet->amount+$wallet->requestedAmount;
            $wallet->requestedAmount=0;
        }
        $wallet->save();
        return response(['message'=>'Wallet Updated']);
    }
}