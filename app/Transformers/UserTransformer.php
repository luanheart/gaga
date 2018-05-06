<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer
{

    public static function transform(User $user, $with_tags = false, $with_wechat = false)
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
            $data['tags'] = TagTransformer::transformCollection($user->tags);
            $data['dreams'] = TagTransformer::transformCollection($user->dreams);
        }
        if ($with_wechat) {
            $data['wechat'] = $user->wechat;
            $data['wechat_img'] = $user->wechat_img;
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