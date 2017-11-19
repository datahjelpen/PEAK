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

	public function taxonomy()
	{
		return $this->belongsTo('App\Model\Object\Taxonomy');
	}

	public function objects()
	{
		return $this->hasMany('App\Model\Object\Object');
	}

	public function parent()
	{
		return $this->belongsTo('App\Model\Object\Term', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('App\Model\Object\Term', 'parent_id');
	}

	# Will make "hasChildren" and "children" properties in object
	function hasChildren()
	{
		$this->children = $this->children()->get();
		$this->hasChildren = count($this->children) ? true : false;
		return $this->hasChildren;
	}

	# Will make "hasChildren" and "children" properties in object recursively into the children
	function getChildrenRecursively()
	{
		if ($this->hasChildren()) {
			foreach ($this->children as $child) {
				$child->getChildrenRecursively();
			}
		}
	}
}
