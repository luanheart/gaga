<?php

namespace App\Transformers;

use App\Models\Tag;

class TagTransformer
{
    public static function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'type' => $tag->type
        ];
    }

    public static function transformCollection($collection)
    {
        $data = [];
        foreach ($collection as $item) {
            $data[] = self::transform($item);
        }
        return $data;
    }
}