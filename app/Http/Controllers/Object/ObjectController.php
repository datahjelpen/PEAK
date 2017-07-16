<?php

namespace App\Http\Controllers\Object;

use \Illuminate\Http\Request;

use \App\Model\Object\Type;
use \App\Model\Object\Object;

class ObjectController extends Controller
{
    public function show(Type $type, Object $object)
    {
        $object = Object::getSingle($type, $object);

        return view('object.show', compact('type', 'object'));
    }
}
