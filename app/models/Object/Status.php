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

	static function getSingle(Type $type, Status $status) {
		return Status::where(['slug' => $status->slug, 'object_type' => $type->id])->first();
	}
}
