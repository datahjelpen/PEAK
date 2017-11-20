<?php

namespace App\Http\Controllers\Item;

use \Illuminate\Http\Request;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;

class TermController extends Controller
{
	public function show(Item_type $item_type, Taxonomy $taxonomy, Term $term)
	{
		$taxonomy = $taxonomy->getSingle($item_type);
		$term = $term->getSingle($taxonomy);
		return view('item.term.show', compact('item_type', 'taxonomy', 'term'));
	}
}
