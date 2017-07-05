<?php

namespace App\Model\Object;

class Term extends Model
{
	protected $table = 'object_terms';

    protected $fillable = [
        'name',
        'slug',
		'parent',
		'template',
		'taxonomy'
    ];

	static function getSingle(Type $type, Taxonomy $taxonomy, Term $term) {
		$taxonomy = Taxonomy::getSingle($type, $taxonomy);
		return Term::where(['slug' => $term->slug, 'taxonomy' => $taxonomy->id])->first();
	}
}
