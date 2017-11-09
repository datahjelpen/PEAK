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

	function hasChildren() {
		$this->getChildren();
		return count($this->children);
	}

	function getChildren() {
		$children = Term::where(['parent' => $this->id])->get();

		if (count($children)) {
			$this->children = $children;
		}
	}

	function getChildrenRecursively() {
		if ($this->hasChildren()) {
			$this->getChildren();

			foreach ($this->children as $child) {
				$child->getChildrenRecursively();
			}
		}
	}
}
