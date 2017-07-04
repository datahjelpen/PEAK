<?php

namespace App\Model\Object;

class Taxonomy extends Model
{
	protected $table = 'object_taxonomies';

    protected $fillable = [
        'name',
        'slug',
        'hierarchical',
        'object_type'
    ];
}
