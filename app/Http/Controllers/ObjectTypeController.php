<?php

namespace App\Http\Controllers;

use App\Object_type;
use Illuminate\Http\Request;

class ObjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('object_type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Object_type  $object_type
     * @return \Illuminate\Http\Response
     */
    public function show(Object_type $object_type)
    {
        return view('object_type.show');
    }
}
