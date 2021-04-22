<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Partner;
use App\Model\Payment;
use Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment=Payment::all();
        return response( array( "message" => "Success", "data" => [
            "payment_method" => $payment])  );           
    }
    public function payment($id)
    {
        $payment=Payment::find($id);
        return response( array( "message" => "Success", "data" => [
            "payment" => $payment])  );           
    }
}