<?php

namespace App\Http\Controllers\Object;

use \Illuminate\Http\Request;

use \App\Model\Object\Type;
use \App\Model\Object\Taxonomy;
use \App\Model\Object\Term;

class TermController extends Controller
{
    public function show(Type $type, Taxonomy $taxonomy, Term $term)
    {
        $taxonomy = Taxonomy::getSingle($type, $taxonomy);
        $term = Term::getSingle($type, $taxonomy, $term);

        return view('object.term.show', compact('type', 'taxonomy', 'term'));
    }
}
