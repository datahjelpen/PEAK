<?php

namespace App\Model\Object;

class Model extends \Illuminate\Database\Eloquent\Model
{
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
