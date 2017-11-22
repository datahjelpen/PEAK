<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function __construct()
    {
       $this->middleware('guest');
    }

    public function index()
    {
        return view('guest.welcome');
    }
}
