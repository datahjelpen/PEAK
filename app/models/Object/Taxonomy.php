<?php

namespace App\Model\Object;

class Taxonomy extends Model
{
	protected $table = 'taxonomies';

    protected $fillable = [
        'name',
        'slug',
        'hierarchical',
        'object_type'
    ];

    }
}
