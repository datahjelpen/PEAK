<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;

class Item_typeController extends Controller
{
    public function index()
    {
        return view('admin.superadmin.item.item_type.index');
    }

    public function create()
    {
        return view('admin.superadmin.item.item_type.create');
    }

    public function store(Request $request)
    {
        $item_type = new Item_type;
        $request->slug = $item_type->make_slug($request);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:item_types|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        $item_type->slug = $request->slug;
        $item_type->name = $request->name;
        $item_type->template = $request->template;

        $item_type->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $item_type)
    {
        return view('admin.superadmin.item.item_type.edit', compact('item_type'));
    }

    public function update(Request $request, Item_type $item_type)
    {
        $slug_changed = $item_type->slug_changed($item_type->slug, $request->slug);
        $request->slug = $item_type->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:item_types,slug,'.$item_type->id.'|string|min:2',
            'template'  => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $item_type->name]));
            return redirect()->route('superadmin.item_type.edit', $item_type->slug)->withErrors($validator)->withInput();
        }

        $item_type->name     = $request->name;
        $item_type->slug     = $request->slug;
        $item_type->template = $request->template;

        $item_type->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $item_type->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.item_type.edit', $item_type->slug);
        }

        return back();
    }

    public function destroy(Item_type $item_type)
    {
        $item_type->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $item_type->name]));
        return back();
    }
}
