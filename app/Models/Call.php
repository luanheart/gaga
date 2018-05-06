<?php

namespace App\Models;

class Call extends Model
{

    protected $fillable = ['user_id', 'target_user_id'];

    public static function isShowWechat($user, $target_user)
    {
        if ($user->id == $target_user->id) {
            return true;
        }
        return self::where(['user_id' => $user->id, 'target_user_id' => $target_user->id])->first()
            && self::where(['user_id' => $target_user->id, 'target_user_id' => $user->id])->first();
    }
}
