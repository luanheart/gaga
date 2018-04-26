<?php
/**
 * Created by PhpStorm.
 * User: xujin
 * Date: 2018/4/26
 * Time: 下午2:59
 */

namespace App\Helpers;

/**
 * Class Error
 * @package App\Helpers
 *
 * @property array UNKNOWN_ERROR
 *
 * @property array NO_USER
 */
class Error
{
    private $properties = [
        'UNKNOWN_ERROR'    => [-1, '未知错误'],

        //user相关
        'NO_USER'    => [2000, '用户不存在'],
    ];

    public function __get($key){
        if (array_key_exists($key, $this->properties)) {
            $property = $this->properties[$key];
            return array('ret' => -1, 'code' => $property[0], 'msg' => $property[1]);
        }
    }
}