<?php

namespace App\Http\Controllers;

use Auth;
use Storage;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			if ($request->user() != null) {
				// Get profile
				$profile = $request->user()->profile;

				// Make sure profile image has an url
				if (isset($profile->image->id)) {
					if ($profile->image->id != null) {
						$profile->image->url = Storage::url($profile->image->url);
					}
				}

				// Make $profile available for all views
				view()->share('profile', $request->user()->profile);
			}

			return $next($request);
		});
	}

	public function home()
	{
		if (Auth::check()) {
			return view('member.hello');
		} else {
			return view('guest.hello');
		}
	}

	public function goodbye()
	{
		return view('member.goodbye');
	}
}
