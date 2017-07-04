<?php

namespace App\Http\Controllers\Admin;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

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
}
