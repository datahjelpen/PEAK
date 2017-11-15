<?php

namespace App\Model\Object;

class TermRelationship extends Model
{
	protected $table = 'object_term_relationships';

    protected $fillable = [
        'object',
        'object_term'
    ];
}
