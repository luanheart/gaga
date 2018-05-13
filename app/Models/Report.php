<?php

namespace App\Models;

class Report extends Model
{

    protected $fillable = ['user_id', 'target_user_id', 'img', 'reason'];

    public function getImgAttribute($value)
    {
        return json_decode($value, true) ?: $value;
    }

    public function setImgAttribute($value)
    {
        $this->attributes['img'] = is_array($value) || is_object($value) ? json_encode($value) : $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class);
    }
}
