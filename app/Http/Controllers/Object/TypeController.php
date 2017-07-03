<?php

namespace App\Http\Controllers\Object;

use \App\Model\Object\Type;
use \Illuminate\Http\Request;

class TypeController extends Controller
{
    public function show(Type $type)
    {
        return view('object_type.show', compact('type'));
    }
}
