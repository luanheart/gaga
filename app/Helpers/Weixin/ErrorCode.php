<?php
/**
 * Created by PhpStorm.
 * User: xujin
 * Date: 2017/10/26
 * Time: 下午12:50
 */

namespace App\Helpers\Weixin;


class ErrorCode
{
    public static $OK = 0;
    public static $IllegalAesKey = -41001;
    public static $IllegalIv = -41002;
    public static $IllegalBuffer = -41003;
    public static $DecodeBase64Error = -41004;
}