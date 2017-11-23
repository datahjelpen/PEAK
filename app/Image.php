<?php

namespace App;

class Image extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'images';

    protected $fillable = [
        'url',
        'size_width',
        'size_height',
        'size_bytes',
        'size_name',
        'alt_tag',
        'title_tag',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profile()
    {
        return $this->hasOne('App\profile');
    }
}
