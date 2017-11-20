<?php

namespace App\Http\Controllers\Item;

use \Illuminate\Http\Request;

use \App\Model\Item\Item_type;
use \App\Model\Item\Item;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;

class ItemController extends Controller
{
    public function show(Item_type $item_type, Taxonomy $taxonomy, Term $term, Item $item)
    {
        return view('item.show', compact('item_type', 'item'));
    }
}
