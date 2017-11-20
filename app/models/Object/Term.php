<?php

namespace App\Model\Item;

class Term extends Model
{
	protected $table = 'terms';

	protected $fillable = [
		'name',
		'slug',
		'template',
		'parent_id'
	];

	public function getSingle(Taxonomy $taxonomy)
	{
		return $taxonomy->terms()->where('slug', '=', $this->slug)->get()->first();
	}

	public function taxonomy()
	{
		return $this->belongsTo('App\Model\Item\Taxonomy');
	}

	public function items()
	{
		return $this->hasMany('App\Model\Item\Item');
	}

	public function parent()
	{
		return $this->belongsTo('App\Model\Item\Term', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('App\Model\Item\Term', 'parent_id');
	}

	# Will make "hasChildren" and "children" properties in item
	function hasChildren()
	{
		$this->children = $this->children()->get();
		$this->hasChildren = count($this->children) ? true : false;
		return $this->hasChildren;
	}

	# Will make "hasChildren" and "children" properties in item recursively into the children
	function getChildrenRecursively()
	{
		if ($this->hasChildren()) {
			foreach ($this->children as $child) {
				$child->getChildrenRecursively();
			}
		}
	}
}
