<?php

namespace App\Http\Controllers\Item;

use \Illuminate\Http\Request;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;

class TaxonomyController extends Controller
{
	public function show(Item_type $item_type, Taxonomy $taxonomy)
	{
		$taxonomy = $taxonomy->getSingle($item_type);
		return view('item.taxonomy.show', compact('item_type', 'taxonomy'));
	}
}
