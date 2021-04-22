<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Contact;
class ContactController extends Controller
{
    public function index()
    {
        $contact=Contact::all();
        return view('admin.contact',compact('contact'));
    }
}