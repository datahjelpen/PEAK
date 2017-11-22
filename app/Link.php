<?php

namespace App;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = [
        'icon',
        'icon_type',
        'title_disp,lay',
        'title_html',
        'link'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
