<?php

namespace App\Model\Item;

class Item_type extends Model
{
    protected $table = 'item_types';

    protected $fillable = [
        'name',
        'slug',
        'template',
    ];

    public function statuses()
    {
        return $this->hasMany('App\Model\Item\Status');
    }


    public function taxonomies()
    {
        return $this->hasMany('App\Model\Item\Taxonomy');
    }

    public function terms()
    {
        return $this->hasManyThrough('App\Model\Item\Term', 'App\Model\Item\Taxonomy');
    }

    public function items()
    {
        return $this->hasMany('App\Model\Item\Item');
    }
}
