<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;
use \App\Model\Object\Term;

class TermController extends Controller
{
    public function index(Type $type, Taxonomy $taxonomy)
    {
        $parents = $taxonomy->terms()->where(['taxonomy_id' => $taxonomy->id, 'parent_id' => null])->get();

        foreach ($parents as $parent) {
            $parent->getChildrenRecursively();
        }

        return view('admin.object.term.index', compact('type', 'taxonomy', 'parents', 'terms'));
    }

    public function create(Type $type, Taxonomy $taxonomy)
    {
        return view('admin.object.term.create', compact('type', 'taxonomy', 'terms'));
    }

    public function store(Type $type, Taxonomy $taxonomy, Request $request)
    {
        $term = new Term;
        $request->slug = $term->make_slug($request);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:terms,slug,NULL,NULL,taxonomy_id,'.$taxonomy->id.'|string|min:2',
            'parent_id' => 'integer|nullable',
            'template'  => 'integer|nullable',
        ]);

        $term->slug = $request->slug;
        $term->name = $request->name;
        $term->template = $request->template;
        $term->parent = $request->parent;
        $term->taxonomy()->associate($taxonomy);

        $term->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type, Taxonomy $taxonomy, Term $term)
    {
        if (session('_old_input') !== null) {
            $slug = $term->slug; // Keep the original slug to prevent url issues
            $term = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $term->_old_slug = $term->slug;
            $term->slug = $slug;
        }

        return view('admin.object.term.edit', compact('type', 'taxonomy', 'term', 'terms'));
    }

    public function update(Type $type, Taxonomy $taxonomy, Request $request, Term $term)
    {
        $slug_changed = $taxonomy->slug_changed($taxonomy->slug, $request->slug);
        $request->slug = $taxonomy->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique_with:terms,taxonomy_id,'.$term->id.'|string|min:2',
            'parent_id' => 'integer|nullable',
            'template'  => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $term->name]));
            return redirect()->route('admin.term.edit', [$type->slug, $taxonomy->slug, $term->slug])->withErrors($validator)->withInput();
        }

        $slug_changed = ($term->slug == $request->slug) ? false : true;

        $term->name     = $request->name;
        $term->slug     = $request->slug;
        $term->parent   = $request->parent;
        $term->template = $request->template;
        $term->taxonomy()->associate($taxonomy);

        $term->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $term->name]));

        if ($slug_changed) {
            return redirect()->route('admin.term.edit', [$type->slug, $taxonomy->slug, $term->slug]);
        }

        return back();
    }

    public function destroy(Type $type, Taxonomy $taxonomy, Term $term)
    {
        // $term->getChildrenRecursively();
        dd($term->parent());

        // $term->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $term->name]));
        return back();
    }
}
