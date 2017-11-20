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
		'item_type_id',
		'author',
		'template',
		'comments',
		'status'
	];

	public function getSingle(Term $term)
	{
		return $term->items()->where('slug', '=', $this->slug)->get()->first();
	}

	public function terms()
	{
		return $this->belongsToMany('App\Model\Item\Term');
	}
}
