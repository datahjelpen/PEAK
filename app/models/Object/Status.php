<?php

namespace App\Model\Object;

class Status extends Model
{
	protected $table = 'statuses';

	protected $fillable = [
		'name',
		'slug',
		'object_type'
	];

	public function getSingle(Type $type)
	{
		return $type->satuses()->where('slug', '=', $this->slug)->get()->first();
	}

	public function type()
	{
			return $this->belongsTo('App\Model\Object\Type');
	}
}
