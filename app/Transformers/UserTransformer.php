<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
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
            'dream' => $user->dream,
            'family_view' => $user->family_view,
            'educational_view' => $user->educational_view,
            'introduction' => $user->introduction,
            'kid' => $user->kid,
            'house' => $user->house,
            'car' => $user->car,
            'country' => $user->country,
            'province' => $user->province,
            'city' => $user->city,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }
}