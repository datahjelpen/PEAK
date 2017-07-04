<?php

namespace App\Http\Controllers\Object;

use \Illuminate\Http\Request;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;

class TaxonomyController extends Controller
{
    public function show(Type $type, Taxonomy $taxonomy)
    {
    	$taxonomy = Taxonomy::getSingle($type, $taxonomy);

        return view('object.taxonomy.show', compact('type', 'taxonomy'));
    }
}
