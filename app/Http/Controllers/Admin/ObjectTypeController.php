<?php

namespace App\Http\Controllers\Admin;

use Session;
use \App\Object_type;
use \Illuminate\Http\Request;

class ObjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $object_types = Object_type::all();
        return view('admin.builder.object_type.index', compact('object_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.builder.object_type.make');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->slug && $request->name) {
            $request->merge(['slug' => str_slug($request->name, '-')]);
        }

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:object_types|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        Object_type::create(request([
            'name',
            'slug',
            'template',
        ]));

        Session::flash('alert-success', 'Successfully created ' . $request->name . '.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Object_type  $object_type
     * @return \Illuminate\Http\Response
     */
    public function show(Object_type $object_type)
    {
        return view('admin.builder.object_type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Object_type  $object_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Object_type $object_type)
    {
        return view('admin.builder.object_type.make');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Object_type  $object_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Object_type $object_type)
    {
        if (!$request->slug && $request->name) {
            $request->merge(['slug' => str_slug($request->name, '-')]);
        }

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:object_types,slug,'.$object_type->slug.'|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        $object_type->name     = $request->name;
        $object_type->slug     = $request->slug;
        $object_type->template = $request->template;

        $object_type->save();

        Session::flash('alert-success', 'Successfully updated ' . $object_type->name . '.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Object_type  $object_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Object_type $object_type)
    {
        $object_type->delete();

        Session::flash('alert-success', 'Successfully deleted ' . $object_type->name . '.');
        return back();
    }
}
