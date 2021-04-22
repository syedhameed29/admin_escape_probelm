<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Wallet;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function wallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'requestedAmount',
        ]);
        if ($validator->passes())
        {
        $wallet=Wallet::find($request->id);
        $wallet->requestedAmount=$request->requestedAmount;
        $wallet->status='requested';
        $wallet->payment='notpaid';
        $wallet->amount=0;
        $wallet->save();
        return response(['message'=>'Wallet amount requested']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    } 
}