<?php

namespace App\Model\Object;

class Model extends \Illuminate\Database\Eloquent\Model
{
	public function getRouteKeyName()
	{
		return 'slug';
	}

	# If user didn't manually enter a slug, let's make on from the name
	public function make_slug($request)
	{
		if (!$request->slug && $request->name) {
			$request->merge(['slug' => str_slug($request->name, '-')]);
		}

		return $request->slug;
	}

	public function slug_changed($original, $new)
	{
		return ($original == $new) ? false : true;
	}

}
