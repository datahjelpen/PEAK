<?php

namespace App\Http\Controllers\Admin;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function oauth()
    {
        return view('auth.oauth-dashboard');
    }
}
