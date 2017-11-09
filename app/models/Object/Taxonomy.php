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

    static function getSingle(Type $type, Taxonomy $taxonomy) {
        return Taxonomy::where(['slug' => $taxonomy->slug, 'object_type' => $type->id])->first();
    }
}
