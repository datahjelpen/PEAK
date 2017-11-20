<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Status;

class StatusController extends Controller
{
    public function index(Type $type, Status $status)
    {
        $status = $status->getSingle($type);
        return view('admin.superadmin.object.status.index', compact('type', 'status'));
    }

    public function create(Type $type)
    {
        return view('admin.superadmin.object.status.create');
    }

    public function store(Type $type, Request $request)
    {
        $status = new Status;
        $request->slug = $status->make_slug($request);

        $this->validate($request, [
            'name' => 'required|string|min:2',
            'slug' => 'required|unique:statuses,slug,NULL,NULL,type_id,'.$type->id.'|string|min:2'
        ]);

        $status->slug = $request->slug;
        $status->name = $request->name;
        $status->type()->associate($type);

        $status->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type, Status $status)
    {
        $status = $status->getSingle($type);
        return view('admin.superadmin.object.status.edit', compact('type', 'status'));
    }

    public function update(Type $type, Request $request, Status $status)
    {
        $status = $status->getSingle($type);

        $request->slug = $status->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'slug' => 'required|unique:statuses,slug,'.$status->id.',id,type_id,'.$type->id.'|string|min:2'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $status->name]));
            return redirect()->route('superadmin.status.edit', [$type->slug, $status->slug])->withErrors($validator)->withInput();
        }

        $status->name = $request->name;
        $status->slug = $request->slug;
        $status->type()->associate($type);

        $status->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $status->name]));

        if ($status->slug_changed($status->slug, $request->slug)) {
            return redirect()->route('superadmin.status.edit', [$type->slug, $status->slug]);
        }

        return back();
    }

    public function destroy(Type $type, Status $status)
    {
        $status = $status->getSingle($type);

        $status->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $status->name]));
        return back();
    }
}
