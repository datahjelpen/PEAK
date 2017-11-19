<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;

class TaxonomyController extends Controller
{
    public function index(Type $type)
    {
        return view('admin.superadmin.object.taxonomy.index', compact('type'));
    }

    public function create(Type $type)
    {
        return view('admin.superadmin.object.taxonomy.create');
    }

    public function store(Type $type, Request $request)
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

    public function edit(Type $type, Taxonomy $taxonomy)
    {
        return view('admin.superadmin.object.taxonomy.edit', compact('type', 'taxonomy'));
    }

    public function update(Type $type, Request $request, Taxonomy $taxonomy)
    {
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

    public function destroy(Type $type, Taxonomy $taxonomy)
    {
        $taxonomy->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $taxonomy->name]));
        return back();
    }
}
