<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'openid',
        'unionid',
        'nickname',
        'avatar',
        'birthday',
        'sex',
        'height',
        'weight',
        'attribute',
        'wechat',
        'wechat_img',
        'job',
        'income',
        'constellation',
        'blood_type',
        'emotion',
        'introduction',
        'country',
        'province',
        'city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function collections()
    {
        return $this->belongsToMany(User::class, 'collections', 'user_id', 'target_user_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'user_tags');
    }

    public function dreams()
    {
        return $this->belongsToMany('App\Models\Tag', 'dream_tags');
    }
}
