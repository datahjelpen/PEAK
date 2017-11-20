<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;

class TaxonomyController extends Controller
{
    public function index(Item_type $type, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($type);
        return view('admin.superadmin.item.taxonomy.index', compact('item_type', 'taxonomy'));
    }

    public function create(Item_type $type)
    {
        return view('admin.superadmin.item.taxonomy.create');
    }

    public function store(Item_type $type, Request $request)
    {
        $taxonomy = new Taxonomy;
        $request->slug = $taxonomy->make_slug($request);
        $request->merge(['hierarchical' => ($request->hierarchical ? true : false) ]);

        $this->validate($request, [
            'name'         => 'required|string|min:2',
            'slug'         => 'required|unique:taxonomies,slug,NULL,NULL,type_id,'.$type->id.'|string|min:2',
            'hierarchical' => 'required|boolean'
        ]);

        $taxonomy->slug = $request->slug;
        $taxonomy->name = $request->name;
        $taxonomy->hierarchical = $request->hierarchical;
        $taxonomy->type()->associate($type);

        $taxonomy->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $type, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($type);
        return view('admin.superadmin.item.taxonomy.edit', compact('item_type', 'taxonomy'));
    }

    public function update(Item_type $type, Request $request, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($type);

        $slug_changed = $taxonomy->slug_changed($taxonomy->slug, $request->slug);
        $request->slug = $taxonomy->make_slug($request);
        $request->merge(['hierarchical' => ($request->hierarchical ? true : false) ]);

        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|min:2',
            'slug'         => 'required|unique:taxonomies,slug,'.$taxonomy->id.',id,type_id,'.$type->id.'|string|min:2',
            'hierarchical' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $taxonomy->name]));
            return redirect()->route('superadmin.taxonomy.edit', [$type->slug, $taxonomy->slug])->withErrors($validator)->withInput();
        }

        $taxonomy->name = $request->name;
        $taxonomy->slug = $request->slug;
        $taxonomy->hierarchical = $request->hierarchical;
        $taxonomy->type()->associate($type);

        $taxonomy->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $taxonomy->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.taxonomy.edit', [$type->slug, $taxonomy->slug])->withErrors($validator)->withInput();
        }

        return back();
    }

    public function destroy(Item_type $type, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($type);

        $taxonomy->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $taxonomy->name]));
        return back();
    }
}
