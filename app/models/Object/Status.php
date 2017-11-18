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

	public function type()
	{
			return $this->belongsTo('App\Model\Object\Type');
	}
}
