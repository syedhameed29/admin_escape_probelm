<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Appointment;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $appointment=Appointment::all();
        return $appointment;
        return view('admin.appointment',compact('appointment'));
    }
}