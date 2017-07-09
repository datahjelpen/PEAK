<?php

namespace App\Http\Controllers\Admin;

use Session;
use \View;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;
use \App\Model\Object\Term;

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
        $this->types = Type::all();
        View::share('types', Type::all());
    }
}
