<?php

namespace App\Http\Controllers\Object;

use \Illuminate\Http\Request;

use \App\Model\Object\Type;
use \App\Model\Object\Object;
use \App\Model\Object\Taxonomy;
use \App\Model\Object\Term;

class ObjectController extends Controller
{
    public function show(Type $type, Taxonomy $taxonomy, Term $term, Object $object)
    {
        return view('object.show', compact('type', 'object'));
    }
}
