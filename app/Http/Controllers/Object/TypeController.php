<?php

namespace App\Http\Controllers\Object;

use \Illuminate\Http\Request;

use \App\Model\Object\Type;

class TypeController extends Controller
{
    public function show(Type $type)
    {
        return view('object.type.show', compact('type'));
    }
}
