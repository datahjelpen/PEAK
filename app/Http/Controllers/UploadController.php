<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Storage;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

use \App\Image;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $this->validate($request, [
            'url'         => 'nullable|string',
            'size_width'  => 'nullable|string',
            'size_height' => 'nullable|string',
            'size_bytes'  => 'nullable|string',
            'size_name'   => 'nullable|string',
            'alt_tag'     => 'nullable|string',
            'title_tag'   => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        if ($request->file('image') != null) {
            $image = new Image;
            $image->url = $request->file('image')->store('user_uploads');
            // $image->size_bytes = $request->file('image')->size;
            // $image->alt_tag = $request->file('image')->originalName;
            $image->size_bytes = '1';
            $image->alt_tag = 'image';
            $image->size_width = '1';
            $image->size_height = '1';
            // $image->title_tag
            // $image->description
            $image->size_name = 'full';
            $image->user()->associate(Auth::user()->id);
            $image->save();

            // Session::flash('alert-success', __('validation.succeeded.create', ['name' => $request->name_display]));
            return $image;
        } else {
            return "bad";
        }
    }
}
