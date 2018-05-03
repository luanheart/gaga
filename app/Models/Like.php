<?php

namespace App\Models;

class Like extends Model
{
    const TYPE_DISLIKE = 0; //不喜欢
    const TYPE_LIKE = 1; //喜欢

    protected $fillable = ['user_id', 'target_user_id', 'type'];

}
