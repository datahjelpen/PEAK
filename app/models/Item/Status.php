<?php

namespace App\Model\Item;

class Status extends Model
{
	protected $table = 'statuses';

	protected $fillable = [
		'name',
		'slug'
	];

	public function getSingle(Item_type $item_type)
	{
		return $item_type->satuses()->where('slug', '=', $this->slug)->get()->first();
	}

	public function item_type()
	{
			return $this->belongsTo('App\Model\Item\Item_type');
	}
}
