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
        'birthday',
        'sex',
        'height',
        'weight',
        'attribute',
        'wechat',
        'job',
        'income',
        'constellation',
        'blood_type',
        'dream',
        'family_view',
        'educational_view',
        'introduction',
        'kid',
        'house',
        'car',
        'country',
        'province',
        'city',
        'status'
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
}
