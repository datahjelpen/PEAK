<?php

namespace App\Model\Item;

class Taxonomy extends Model
{
	protected $table = 'taxonomies';

    protected $fillable = [
        'name',
        'slug',
        'hierarchical'
    ];

    public function getSingle(Item_type $item_type)
    {
        return $item_type->taxonomies()->where('slug', '=', $this->slug)->get()->first();
    }

    public function item_type()
    {
        return $this->belongsTo('App\Model\Item\Item_type');
    }

    public function terms()
    {
        return $this->hasMany('App\Model\Item\Term');
    }
}
