<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer
{

    public static function transform(User $user, $with_tags = false)
    {
        $data = [
            'id' => $user->id,
            'nickname' => $user->nickname,
            'sex' => $user->sex,
            'avatar' => $user->avatar,
            'birthday' => $user->birthday,
            'attribute' => $user->attribute,
            'height' => $user->height,
            'weight' => $user->weight,
            'job' => $user->job,
            'income' => $user->income,
            'constellation' => $user->constellation,
            'blood_type' => $user->blood_type,
            'emotion' => $user->emotion,
            'introduction' => $user->introduction,
            'country' => $user->country,
            'province' => $user->province,
            'city' => $user->city,
        ];
        if ($with_tags) {
            $tags = [];
            if ($raw_tags = $user->tags) {
                foreach ($raw_tags as $item) {
                    $tags[] = [
                        'id' => $item->id,
                        'name' => $item->name,
                        'type' => $item->type
                    ];
                }
            }
            $data['tags'] = $tags;

            $dreams = [];
            if ($raw_dreams = $user->dreams) {
                foreach ($raw_dreams as $item) {
                    $dreams[] = [
                        'id' => $item->id,
                        'name' => $item->name,
                        'type' => $item->type
                    ];
                }
            }
            $data['dreams'] = $dreams;
        }
        return $data;
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