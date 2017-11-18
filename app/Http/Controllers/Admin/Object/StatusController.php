<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Status;

class StatusController extends Controller
{
    public function index(Type $type)
    {
        $statuses = Status::all()->where('object_type', $type->id);
        return view('admin.superadmin.object.status.index', compact('type', 'statuses'));
    }

    public function create(Type $type)
    {
        return view('admin.superadmin.object.status.create');
    }

    public function store(Type $type, Request $request)
    {
        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        $request->merge(['object_type' => $type->id]);

        $this->validate($request, [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:statuses,object_type|string|min:2',
        ]);

        Status::create(request([
            'name',
            'slug',
            'object_type'
        ]));

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type, Status $status)
    {
        $status = Status::getSingle($type, $status);

        if (session('_old_input') !== null) {
            $slug = $status->slug; // Keep the original slug to prevent url issues
            $status = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $status->_old_slug = $status->slug;
            $status->slug = $slug;
        }

        return view('admin.superadmin.object.status.edit', compact('type', 'status'));
    }

    public function update(Type $type, Request $request, Status $status)
    {
        $status = Status::getSingle($type, $status);

        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        // TODO: allow users to move a status to another object_type
        $request->merge(['object_type' => $type->id]);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:statuses,object_type,'.$status->id.'|string|min:2',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $status->name]));
            return redirect()->route('superadmin.status.edit', [$type->slug, $status->slug])->withErrors($validator)->withInput();
        }

        $slug_changed = ($status->slug == $request->slug) ? false : true;

        $status->name     = $request->name;
        $status->slug     = $request->slug;

        $status->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $status->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.status.edit', [$type->slug, $status->slug]);
        }

        return back();
    }

    public function destroy(Type $type, Status $status)
    {
        $status = Status::getSingle($type, $status);

        $status->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $status->name]));
        return back();
    }
}
