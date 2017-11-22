<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        $profile = Auth::user()->profile;

        if ($profile == null) return redirect()->route('profile.create');

        return view('profile.index', compact('profile'));
    }

    public function create()
    {
        if (Auth::user()->profile != null) return redirect()->route('profile');

        return view('profile.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->profile != null) return redirect()->route('profile');

        $this->validate($request, [
            'name_first'    => 'nullable|string',
            'name_last'     => 'nullable|string',
            'name_display'  => 'nullable|string',
            'title'         => 'nullable|string',
            'email_display' => 'nullable|string',
            'description'   => 'nullable|string'
        ]);

        $profile = new Profile;
        $profile->name_first = $request->name_first;
        $profile->name_last = $request->name_last;
        $profile->name_display = $request->name_display;
        $profile->title = $request->title;
        $profile->email_display = $request->email_display;
        $profile->description = $request->description;
        $profile->user()->associate(Auth::user()->id);
        $profile->save();

        Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name_display]));
        return redirect()->route('profile');
    }

    public function edit_mine()
    {
        $profile = Auth::user()->profile;

        return view('profile.edit', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $validator = Validator::make($request->all(), [
            'name_first'    => 'nullable|string',
            'name_last'     => 'nullable|string',
            'name_display'  => 'nullable|string',
            'title'         => 'nullable|string',
            'email_display' => 'nullable|string',
            'description'   => 'nullable|string'
        ]);

        if ($validator->fails()) {
            Session::flash('alert-danger', __('validation.failed.update', ['name' => $profile->name_display]));
            return redirect()->route('superadmin.profile.edit', $profile->slug)->withErrors($validator)->withInput();
        }

        $profile->name_first = $request->name_first;
        $profile->name_last = $request->name_last;
        $profile->name_display = $request->name_display;
        $profile->title = $request->title;
        $profile->email_display = $request->email_display;
        $profile->description = $request->description;
        $profile->save();

        Session::flash('alert-success', __('validation.succeeded.update', ['name' => $profile->name_display]));

        return redirect()->route('profile');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        Session::flash('alert-success', __('validation.succeeded.delete', ['name' => $profile->name_display]));
        return back();
    }
}
