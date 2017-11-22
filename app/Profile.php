<?php

namespace App;

class Profile extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'profiles';

    protected $fillable = [
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
}
