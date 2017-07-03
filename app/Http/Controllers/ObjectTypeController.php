<?php

namespace App\Http\Controllers;

use App\Object_type;
use Illuminate\Http\Request;

class ObjectTypeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Object_type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Object_type $type)
    {
        return view('object_type.show', compact('type'));
    }
}
