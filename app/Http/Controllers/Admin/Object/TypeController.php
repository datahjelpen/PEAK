<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;

class TypeController extends Controller
{
    public function index()
    {
        return view('admin.superadmin.object.type.index');
    }

    public function create()
    {
        return view('admin.superadmin.object.type.create');
    }

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

        Type::create(request([
            'name',
            'slug',
            'template',
        ]));

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type)
    {
        if (session('_old_input') !== null) {
            $slug = $type->slug; // Keep the original slug to prevent url issues
            $type = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $type->_old_slug = $type->slug;
            $type->slug = $slug;
        }

        return view('admin.superadmin.object.type.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
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
            return redirect()->route('superadmin.object.type.edit', $type->slug)->withErrors($validator)->withInput();
        }

        $slug_changed = ($type->slug == $request->slug) ? false : true;

        $type->name     = $request->name;
        $type->slug     = $request->slug;
        $type->template = $request->template;

        $type->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $type->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.object.type.edit', $type->slug);
        }

        return back();
    }

    public function destroy(Type $type)
    {
        $type->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $type->name]));
        return back();
    }
}
