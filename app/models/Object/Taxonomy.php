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

    public function getSingle(Type $type)
    {
        return $type->taxonomies()->where('slug', '=', $this->slug)->get()->first();
    }

    public function type()
    {
        return $this->belongsTo('App\Model\Object\Type');
    }

    public function terms()
    {
        return $this->hasMany('App\Model\Object\Term');
    }
}
