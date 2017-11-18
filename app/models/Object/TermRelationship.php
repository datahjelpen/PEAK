<?php

namespace App\Model\Object;

class TermRelationship extends Model
{
	protected $table = 'object_term';

    protected $fillable = [
        'object_id',
        'term_id'
    ];
}
