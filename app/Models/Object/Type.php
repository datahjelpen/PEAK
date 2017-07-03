<?php

namespace App\Model\Object;

class Type extends Model
{
	protected $table = 'object_types';

    protected $fillable = [
        'name',
        'slug',
        'template',
    ];
}
