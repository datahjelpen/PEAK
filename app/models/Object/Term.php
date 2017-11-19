<?php

namespace App\Model\Object;

class Term extends Model
{
	protected $table = 'terms';

		protected $fillable = [
			'name',
			'slug',
			'parent',
			'template',
			'taxonomy'
		];

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
			$this->hasChildren = true;
			$this->getChildren();

			foreach ($this->children as $child) {
				$child->getChildrenRecursively();
			}
		} else {
			$this->hasChildren = false;
		}
	}
}
