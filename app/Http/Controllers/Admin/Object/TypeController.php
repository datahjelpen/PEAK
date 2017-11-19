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
        $type = new Type;
        $request->slug = $type->make_slug($request);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:object_types|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        $type->slug = $request->slug;
        $type->name = $request->name;
        $type->template = $request->template;

        $type->save();

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
        $slug_changed = $type->slug_changed($type->slug, $request->slug);
        $request->slug = $type->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:object_types,slug,'.$type->id.'|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $type->name]));
            return redirect()->route('superadmin.type.edit', $type->slug)->withErrors($validator)->withInput();
        }

        $type->name     = $request->name;
        $type->slug     = $request->slug;
        $type->template = $request->template;

        $type->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $type->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.type.edit', $type->slug);
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
