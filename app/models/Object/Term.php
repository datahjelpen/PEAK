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

	function hasChildren()
	{
		$this->getChildren();
		return count($this->children);
	}

	function getChildren()
	{
		$children = Term::where(['parent_id' => $this->id])->get();

		if (count($children)) {
			$this->children = $children;
		}
	}

	function getChildrenRecursively()
	{

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
