<?php

namespace App\Model\Item;

class Item extends Model
{
	protected $table = 'items';

	protected $fillable = [
		'name',
		'slug',
		'text',
		'excerpt',
		'template',
		'comments',
	];

	public function getSingle(Item_type $item_type)
	{
		return $item_type->items()->where('slug', '=', $this->slug)->get()->first();
	}

	public function terms()
	{
		return $this->belongsToMany('App\Model\Item\Term');
	}

	public function item_type()
	{
		return $this->belongsTo('App\Model\Item\Item_type');
	}

	public function author()
	{
		return $this->belongsTo('App\User');
	}

	public function status()
	{
		return $this->belongsTo('App\Model\Item\Status');
	}
}
