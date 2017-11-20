<?php

namespace App\Http\Controllers\Admin;

use Session;
use \View;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;

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
        $this->item_types = Item_type::all();
        View::share('item_types', Item_type::all());
    }
}
