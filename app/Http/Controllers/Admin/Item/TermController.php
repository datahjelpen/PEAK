<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;

class TermController extends Controller
{
    public function index(Item_type $item_type, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($item_type);

        if ($taxonomy->hierarchical) {
            $parents = $taxonomy->terms()->where(['parent_id' => null])->get();
            foreach ($parents as $parent) $parent->getChildrenRecursively();
        } else {
            $parents = $taxonomy->terms()->get();
        }

        return view('admin.item.term.index', compact('item_type', 'taxonomy', 'parents'));
    }

    public function create(Item_type $item_type, Taxonomy $taxonomy)
    {
        $taxonomy = $taxonomy->getSingle($item_type);

        if ($taxonomy->hierarchical) {
            $parents = $taxonomy->terms()->where(['parent_id' => null])->get();
            foreach ($parents as $parent) $parent->getChildrenRecursively();
        } else {
            $parents = $taxonomy->terms()->get();
        }

        return view('admin.item.term.create', compact('item_type', 'taxonomy', 'parents'));
    }

    public function store(Item_type $item_type, Taxonomy $taxonomy, Request $request)
    {
        $taxonomy = $taxonomy->getSingle($item_type);

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
        $term->parent()->associate($request->parent_id);
        $term->taxonomy()->associate($taxonomy);

        $term->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $item_type, Taxonomy $taxonomy, Term $term)
    {
        $taxonomy = $taxonomy->getSingle($item_type);
        $term = $term->getSingle($taxonomy);

        if ($taxonomy->hierarchical) {
            $parents = $taxonomy->terms()->where(['parent_id' => null])->get();
            foreach ($parents as $parent) $parent->getChildrenRecursively();
        } else {
            $parents = $taxonomy->terms()->get();
        }

        return view('admin.item.term.edit', compact('item_type', 'taxonomy', 'term', 'parents'));
    }

    public function update(Item_type $item_type, Taxonomy $taxonomy, Request $request, Term $term)
    {
        $taxonomy = $taxonomy->getSingle($item_type);
        $term = $term->getSingle($taxonomy);

        $slug_changed = $taxonomy->slug_changed($taxonomy->slug, $request->slug);
        $request->slug = $taxonomy->make_slug($request);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:terms,slug,'.$term->id.',id,taxonomy_id,'.$taxonomy->id.'|string|min:2',
            'parent_id' => 'integer|nullable|not_in:'.$term->id,
            'template'  => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $term->name]));
            return redirect()->route('admin.term.edit', [$item_type->slug, $taxonomy->slug, $term->slug])->withErrors($validator)->withInput();
        }

        $term->name     = $request->name;
        $term->slug     = $request->slug;
        $term->template = $request->template;
        $term->parent()->associate($request->parent_id);
        $term->taxonomy()->associate($taxonomy);

        $term->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $term->name]));

        if ($slug_changed) {
            return redirect()->route('admin.term.edit', [$item_type->slug, $taxonomy->slug, $term->slug]);
        }

        return back();
    }

    public function destroy(Item_type $item_type, Taxonomy $taxonomy, Term $term)
    {
        $taxonomy = $taxonomy->getSingle($item_type);
        $term = $term->getSingle($taxonomy);

        $term->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $term->name]));
        return back();
    }
}
