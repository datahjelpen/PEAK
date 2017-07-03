<?php

namespace App\Http\Controllers\Admin;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Object_type;

class ObjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Object_type::all();
        return view('admin.builder.object_type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.builder.object_type.create');
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

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Object_type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Object_type $type)
    {
        return redirect()->route('object.type.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Object_type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Object_type $type)
    {
        if (session('_old_input') !== null) {
            $slug = $type->slug; // Keep the original slug to prevent url issues
            $type = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $type->_old_slug = $type->slug;
            $type->slug = $slug;
        }

        return view('admin.builder.object_type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Object_type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Object_type $type)
    {
        if (!$request->slug && $request->name) {
            $request->merge(['slug' => str_slug($request->name, '-')]);
        }

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:object_types,slug,'.$type->id.'|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $type->name]));
            return redirect()->route('object.type.edit', $type->slug)->withErrors($validator)->withInput();
        }

        $slug_changed = ($type->slug == $request->slug) ? false : true;

        $type->name     = $request->name;
        $type->slug     = $request->slug;
        $type->template = $request->template;

        $type->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $type->name]));

        if ($slug_changed) {
            return redirect()->route('object.type.edit', $type->slug);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Object_type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Object_type $type)
    {
        $type->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $type->name]));
        return back();
    }
}
