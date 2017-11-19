<?php

namespace App\Http\Controllers\Admin\Object;

use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;
use \App\Model\Object\Term;
use \App\Model\Object\Object;
use \App\Model\Object\Status;

class ObjectController extends Controller
{
    public function index(Type $type)
    {
        $objects = Object::all()->where('object_type', $type->id);
        $taxonomies = Taxonomy::all()->where('object_type', $type->id);

        foreach ($taxonomies as $taxonomy) {
            $terms = Term::where(['taxonomy' => $taxonomy->id, 'parent' => null])->get();

            foreach ($terms as $term) {
                $term->getChildrenRecursively();
            }
        }

        $statuses = Status::all()->where('object_type', $type->id);

        return view('admin.object.index', compact('type', 'taxonomies', 'terms', 'objects', 'statuses'));
    }

    public function create(Type $type)
    {
        return view('admin.object.create');
    }

    public function store(Type $type, Request $request)
    {
        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        $request->merge(['object_type' => $type->id]);
        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $this->validate($request, [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:objects,object_type,'.$type->id.'|string|min:2',
            'text'          => 'required|string',
            'excerpt'       => 'required|string',
            'object_type'   => 'required|integer',
            'author'        => 'required|integer',
            'template'      => 'required|integer',
            'comments'      => 'required|boolean',
            'status'        => 'required|unique_with:objects,status,'.$request->status.'|integer',
            'terms'         => 'required'
        ]);

        $object = Object::create(request([
            'name',
            'slug',
            'text',
            'excerpt',
            'object_type',
            'author',
            'template',
            'comments',
            'status'
        ]));

        if (count($request['terms']) != 0) {
            foreach ($request['terms'] as $term) {
                $object->terms()->attach($term);
            }
        }

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name]));
        return back();
    }

    public function edit(Type $type, Object $object)
    {
        $object = Object::getSingle($type, $object);

        if (session('_old_input') !== null) {
            $slug = $object->slug; // Keep the original slug to prevent url issues
            $object = json_decode(json_encode(session('_old_input')), false); // Fill object with old input values
            $object->_old_slug = $object->slug;
            $object->slug = $slug;
        }

        return view('admin.object.edit', compact('type', 'object'));
    }

    public function update(Type $type, Request $request, Object $object)
    {
        $object = Object::getSingle($type, $object);

        if (!$request->slug && $request->name) $request->merge(['slug' => str_slug($request->name, '-')]);

        // TODO: allow users to move a object to another object_type
        $request->merge(['object_type' => $type->id]);
        $request->merge(['comments' => ($request->comments ? true : false) ]);

        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|min:2',
            'slug'          => 'required|unique_with:objects,object_type,'.$object->id.'|string|min:2',
            'text'          => 'required|string',
            'excerpt'       => 'required|string',
            'object_type'   => 'required|integer',
            'author'        => 'required|integer',
            'template'      => 'required|integer',
            'comments'      => 'required|boolean',
            'status'        => 'required|unique_with:objects,status,'.$object->id.'integer|'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $object->name]));
            return redirect()->route('admin.object.edit', [$type->slug, $object->slug])->withErrors($validator)->withInput();
        }

        $slug_changed = ($object->slug == $request->slug) ? false : true;

        $object->name        = $request->name;
        $object->slug        = $request->slug;
        $object->text        = $request->text;
        $object->excerpt     = $request->excerpt;
        $object->object_type = $request->object_type;
        $object->author      = $request->author;
        $object->template    = $request->template;
        $object->comments    = $request->comments;
        $object->status      = $request->status;

        $object->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $object->name]));

        if ($slug_changed) {
            return redirect()->route('admin.object.edit', [$type->slug, $object->slug]);
        }

        return back();
    }

    public function destroy(Type $type, Object $object)
    {
        $object = Object::getSingle($type, $object);

        $object->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $object->name]));
        return back();
    }
}
