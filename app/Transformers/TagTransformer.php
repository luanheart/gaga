<?php

namespace App\Transformers;

use App\Models\Tag;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'type' => $tag->type
        ];
    }
}