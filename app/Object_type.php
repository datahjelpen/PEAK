<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object_type extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'template',
        'rights'
    ];
}
