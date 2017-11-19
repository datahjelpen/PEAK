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
        $taxonomies = Taxonomy::all()->where('object_type', $type->id);
        return view('admin.superadmin.object.taxonomy.index', compact('type', 'taxonomies'));
    }

    public function create(Type $type)
    {
        return view('admin.superadmin.object.taxonomy.create');
    }

    public function store(Type $type, Request $request)
    {
        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        $request->merge(['object_type' => $type->id]);
        $request->merge(['hierarchical' => ($request->hierarchical ? true : false) ]);

        $this->validate($request, [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:taxonomies,object_type|string|min:2',
            'hierarchical'  => 'required|boolean',
        ]);

        Taxonomy::create(request([
            'name',
            'slug',
            'hierarchical',
            'object_type'
        ]));

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type, Taxonomy $taxonomy)
    {
        $taxonomy = Taxonomy::getSingle($type, $taxonomy);

        if (session('_old_input') !== null) {
            $slug = $taxonomy->slug; // Keep the original slug to prevent url issues
            $taxonomy = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $taxonomy->_old_slug = $taxonomy->slug;
            $taxonomy->slug = $slug;
        }

        return view('admin.superadmin.object.taxonomy.edit', compact('type', 'taxonomy'));
    }

    public function update(Type $type, Request $request, Taxonomy $taxonomy)
    {
        $taxonomy = Taxonomy::getSingle($type, $taxonomy);

        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        // TODO: allow users to move a taxonomy to another object_type
        $request->merge(['object_type' => $type->id]);
        $request->merge(['hierarchical' => ($request->hierarchical ? true : false) ]);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:taxonomies,object_type,'.$taxonomy->id.'|string|min:2',
            'hierarchical'  => 'required|boolean',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $taxonomy->name]));
            return redirect()->route('superadmin.taxonomy.edit', [$type->slug, $taxonomy->slug])->withErrors($validator)->withInput();
        }

        $slug_changed = ($taxonomy->slug == $request->slug) ? false : true;

        $taxonomy->name     = $request->name;
        $taxonomy->slug     = $request->slug;
        $taxonomy->hierarchical = $request->hierarchical;

        $taxonomy->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $taxonomy->name]));

        if ($slug_changed) {
            return redirect()->route('superadmin.taxonomy.edit', [$type->slug, $taxonomy->slug])->withErrors($validator)->withInput();
        }

        return back();
    }

    public function destroy(Type $type, Taxonomy $taxonomy)
    {
        $taxonomy = Taxonomy::getSingle($type, $taxonomy);

        $taxonomy->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $taxonomy->name]));
        return back();
    }
}
