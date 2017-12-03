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
        $item = $item->getSingle($item_type);

        // Make sure the route only works for the correct term
        if (isset($item->terms)) {
            foreach ($item->terms as $item_term) {
                if ($item_term->id == $term->id) {
                    return view('item.show', compact('item_type', 'item'));
                }
            }

            return redirect()->route('item.show', [$item_type->slug, $taxonomy->slug, $item->terms->first()->slug, $item->slug]);
        }

        return abort(404);
    }
}
