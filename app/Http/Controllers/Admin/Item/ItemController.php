<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\User;
use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;
use \App\Model\Item\Item;
use \App\Model\Item\Status;

class ItemController extends Controller
{
    public function index(Item_type $item_type)
    {
        // Set a hierarchial taxonomy's "parents" key to be it's parent terms
        foreach ($item_type->taxonomies as $taxonomy) {
            if ($taxonomy->hierarchical) {
                $taxonomy->parents = $taxonomy->terms()->where(['parent_id' => null])->get();
                foreach ($taxonomy->parents as $parent) $parent->getChildrenRecursively();
            } else {
                $taxonomy->parents = $taxonomy->terms()->get();
            }
        }

        // Loop through all the items and assign a simple array containing attached terms
        foreach ($item_type->items as $item) {
            $terms_simple = [];
            foreach ($item->terms as $term) array_push($terms_simple, $term->id);
            $item->terms_simple = $terms_simple;
        }

        // If the session contains an item's terms, put them in a simple array
        if (old('terms') != null) {
            $item = new \stdClass();
            $terms_simple = [];
            foreach (old('terms') as $term) array_push($terms_simple, $term);
            $item->terms_simple = $terms_simple;

            return view('admin.item.index', compact('item_type', 'item'));
        }

        $users = User::all();

        return view('admin.item.index', compact('item_type', 'users'));
    }

    public function create(Item_type $item_type)
    {
        return view('admin.item.create');
    }

    public function store(Item_type $item_type, Request $request)
    {
        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        $item = new Item;
        $request->slug = $item->make_slug($request);

        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:items,slug,NULL,NULL,item_type_id,'.$item_type->id.'|string|min:2',
            'text'      => 'required|string',
            'excerpt'   => 'required|string',
            'author_id' => 'required|integer',
            'template'  => 'required|integer',
            'comments'  => 'required|boolean',
            'status_id' => 'required|integer',
            'terms'     => 'required'
        ]);

        $item->name     = $request->name;
        $item->slug     = $request->slug;
        $item->text     = $request->text;
        $item->excerpt  = $request->excerpt;
        $item->template = $request->template;
        $item->comments = $request->comments;

        $item->item_type()->associate($item_type);
        $item->status()->associate($request->status_id);
        $item->author()->associate($request->author_id);

        $item->save();
        
        foreach ($request['terms'] as $term) {
            $item->terms()->attach($term);
        }

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $item_type, Item $item)
    {
        $item = $item->getSingle($item_type);

        foreach ($item_type->taxonomies as $taxonomy) {
            if ($taxonomy->hierarchical) {
                $taxonomy->parents = $taxonomy->terms()->where(['parent_id' => null])->get();
                foreach ($taxonomy->parents as $parent) $parent->getChildrenRecursively();
            } else {
                $taxonomy->parents = $taxonomy->terms()->get();
            }
        }

        $terms_simple = [];

        if (old('terms') != null) {
            foreach (old('terms') as $term) array_push($terms_simple, $term);
        } else {
            foreach ($item->terms as $term) array_push($terms_simple, $term->id);
        }

        $item->terms_simple = $terms_simple;

        $users = User::all();

        return view('admin.item.edit', compact('item_type', 'item', 'users'));
    }

    public function update(Item_type $item_type, Request $request, Item $item)
    {
        $item = $item->getSingle($item_type);

        $slug_changed = $item->slug_changed($item->slug, $request->slug);

        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:items,slug,'.$item->id.',id,item_type_id,'.$item_type->id.'|string|min:2',
            'text'      => 'required|string',
            'excerpt'   => 'required|string',
            'author_id' => 'required|integer',
            'template'  => 'required|integer',
            'comments'  => 'required|boolean',
            'status_id' => 'required|integer',
            'terms'     => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $item->name]));
            return redirect()->route('admin.item.edit', [$item_type->slug, $item->slug])->withErrors($validator)->withInput();
        }

        $item->name      = $request->name;
        $item->slug      = $request->slug;
        $item->text      = $request->text;
        $item->excerpt   = $request->excerpt;
        $item->template  = $request->template;
        $item->comments  = $request->comments;

        $item->item_type()->associate($item_type);
        $item->status()->associate($request->status_id);
        $item->author()->associate($request->author_id);
        $item->terms()->sync($request['terms']);

        $item->save();
        

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $item->name]));

        if ($slug_changed) {
            return redirect()->route('admin.item.edit', [$item_type->slug, $item->slug]);
        }

        return back();
    }

    public function destroy(Item_type $item_type, Item $item)
    {
        $item = $item->getSingle($item_type);

        $item->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $item->name]));
        return back();
    }
}
