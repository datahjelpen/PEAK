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
        $statuses = Status::all()->where('type_id', $type->id);
        return view('admin.superadmin.object.status.index', compact('type', 'statuses'));
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
            'slug' => 'required|unique_with:statuses,type_id|string|min:2'
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
        $request->slug = $status->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'slug' => 'required|unique_with:statuses,type_id,'.$status->id.'|string|min:2',
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
        $status->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $status->name]));
        return back();
    }
}
