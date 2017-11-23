<?php

namespace App\Http\Controllers\Admin;

use Storage;
use Session;
use \View;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Model\Item\Item_type;
use \App\Model\Item\Taxonomy;
use \App\Model\Item\Term;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->item_types = Item_type::all();
        View::share('item_types', Item_type::all());

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
}
