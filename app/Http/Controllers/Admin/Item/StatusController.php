<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Status;

class StatusController extends Controller
{
    public function index(Item_type $item_type, Status $status)
    {
        $status = $status->getSingle($item_type);
        return view('admin.superadmin.item.status.index', compact('item_type', 'status'));
    }

    public function create(Item_type $item_type)
    {
        return view('admin.superadmin.item.status.create');
    }

    public function store(Item_type $item_type, Request $request)
    {
        $status = new Status;
        $request->slug = $status->make_slug($request);

        $this->validate($request, [
            'name' => 'required|string|min:2',
            'slug' => 'required|unique:statuses,slug,NULL,NULL,item_type_id,'.$item_type->id.'|string|min:2'
        ]);

        $status->slug = $request->slug;
        $status->name = $request->name;
        $status->item_type()->associate($item_type);

        $status->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $item_type, Status $status)
    {
        $status = $status->getSingle($item_type);
        return view('admin.superadmin.item.status.edit', compact('item_type', 'status'));
    }

    public function update(Item_type $item_type, Request $request, Status $status)
    {
        $status = $status->getSingle($item_type);

        $request->slug = $status->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'slug' => 'required|unique:statuses,slug,'.$status->id.',id,item_type_id,'.$item_type->id.'|string|min:2'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $status->name]));
            return redirect()->route('superadmin.status.edit', [$item_type->slug, $status->slug])->withErrors($validator)->withInput();
        }

        $status->name = $request->name;
        $status->slug = $request->slug;
        $status->item_type()->associate($item_type);

        $status->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $status->name]));

        if ($status->slug_changed($status->slug, $request->slug)) {
            return redirect()->route('superadmin.status.edit', [$item_type->slug, $status->slug]);
        }

        return back();
    }

    public function destroy(Item_type $item_type, Status $status)
    {
        $status = $status->getSingle($item_type);

        $status->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $status->name]));
        return back();
    }
}
