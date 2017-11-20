<?php

namespace App\Http\Controllers\Item;

use \Illuminate\Http\Request;

use \App\Model\Item\Item_type;

class Item_typeController extends Controller
{
    public function show(Item_type $item_type)
    {
        return view('item.item_type.show', compact('item_type'));
    }
}
