<?php

namespace App\Models;

class Tag extends Model
{

    protected $fillable = ['name', 'type'];

    public function typeName()
    {
        return $this->belongsTo(TagType::class, 'type');
    }

}
