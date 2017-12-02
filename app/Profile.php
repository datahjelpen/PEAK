<?php

namespace App;

class Profile extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'url',
        'name_first',
        'name_last',
        'name_display',
        'title',
        'email_display',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function image()
    {
        return $this->belongsTo('App\Image')->withDefault([
            'url' => '/images/peak/graphics/peak-comp.png',
            'alt' => 'PEAK avatar'
        ]);
    }
}
