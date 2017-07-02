<?php

namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
