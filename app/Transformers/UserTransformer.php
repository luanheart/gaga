<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['tags', 'dreams'];

    public function transform(User $user)
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
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
        if (\Auth::user()->id === $user->id) {
            $data['wechat'] = $user->wechat;
            $data['wechat_img'] = $user->wechat_img;
        }
        return $data;
    }

    public function includeTags(User $user)
    {
        return $this->collection($user->tags, new TagTransformer());
    }

    public function includeDreams(User $user)
    {
        return $this->collection($user->dreams, new TagTransformer());
    }
}