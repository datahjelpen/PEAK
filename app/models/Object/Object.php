<?php

namespace App\Model\Object;

class Object extends Model
{
	protected $table = 'objects';

	protected $fillable = [
		'name',
		'slug',
		'text',
		'excerpt',
		'object_type',
		'author',
		'template',
		'comments',
		'status'
	];

	public function getSingle(Term $term)
	{
		return $term->objects()->where('slug', '=', $this->slug)->get()->first();
	}

	public function terms()
	{
		return $this->belongsToMany('App\Model\Object\Term');
	}
}
