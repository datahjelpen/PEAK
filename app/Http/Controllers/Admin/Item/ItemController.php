<?php

namespace App\Http\Controllers\Admin\Item;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;
use \App\Model\Item\Item;
use \App\Model\Item\Status;

class ItemController extends Controller
{
    public function index(Item_type $item_type)
    {
        $items = Item::all()->where('item_type', $item_type->id);
        $taxonomies = Taxonomy::all()->where('item_type', $item_type->id);

        foreach ($taxonomies as $taxonomy) {
            $terms = Term::where(['taxonomy' => $taxonomy->id, 'parent' => null])->get();

            foreach ($terms as $term) {
                $term->getChildrenRecursively();
            }
        }

        $statuses = Status::all()->where('item_type', $item_type->id);

        return view('admin.item.index', compact('type', 'taxonomies', 'terms', 'items', 'statuses'));
    }

    public function create(Item_type $item_type)
    {
        return view('admin.item.create');
    }

    public function store(Item_type $item_type, Request $request)
    {
        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        $request->merge(['item_type' => $item_type->id]);
        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique:items,slug,NULL,NULL,item_type_id,'.$item_type->id.'|string|min:2',
            'text'      => 'required|string',
            'excerpt'   => 'required|string',
            'author'    => 'required|integer',
            'template'  => 'required|integer',
            'comments'  => 'required|boolean',
            'status'    => 'required|integer',
            'terms'     => 'required'
        ]);

        $item = Item::create(request([
            'name',
            'slug',
            'text',
            'excerpt',
            'item_type',
            'author',
            'template',
            'comments',
            'status'
        ]));

        if (count($request['terms']) != 0) {
            foreach ($request['terms'] as $term) {
                $item->terms()->attach($term);
            }
        }

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Item_type $item_type, Item $item)
    {
        $item = Item::getSingle($item_type, $item);

        if (session('_old_input') !== null) {
            $slug = $item->slug; // Keep the original slug to prevent url issues
            $item = json_decode(json_encode(session('_old_input')), false); // Fill item with old input values
            $item->_old_slug = $item->slug;
            $item->slug = $slug;
        }

        return view('admin.item.edit', compact('type', 'item'));
    }

    public function update(Item_type $item_type, Request $request, Item $item)
    {
        $slug_changed = $item->slug_changed($item->slug, $request->slug);
        $item = Item::getSingle($item_type, $item);

        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        // TODO: allow users to move a item to another item_type
        $request->merge(['item_type' => $item_type->id]);
        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2',
            'slug'      => 'required|unique_with:items,item_type,'.$item->id.'|string|min:2',
            'text'      => 'required|string',
            'excerpt'   => 'required|string',
            'item_type' => 'required|integer',
            'author'    => 'required|integer',
            'template'  => 'required|integer',
            'comments'  => 'required|boolean',
            'status'    => 'required|unique_with:items,status,'.$item->id.'integer|'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $item->name]));
            return redirect()->route('admin.item.edit', [$item_type->slug, $item->slug])->withErrors($validator)->withInput();
        }

        $item->name      = $request->name;
        $item->slug      = $request->slug;
        $item->text      = $request->text;
        $item->excerpt   = $request->excerpt;
        $item->item_type = $request->item_type;
        $item->author    = $request->author;
        $item->template  = $request->template;
        $item->comments  = $request->comments;
        $item->status    = $request->status;

        $item->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $item->name]));

        if ($slug_changed) {
            return redirect()->route('admin.item.edit', [$item_type->slug, $item->slug]);
        }

        return back();
    }

    public function destroy(Item_type $item_type, Item $item)
    {
        $item = Item::getSingle($item_type, $item);

        $item->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $item->name]));
        return back();
    }
}
