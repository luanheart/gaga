<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Error;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Routing\Helpers;

/**
 * Class Controller
 * @package App\Http\Controllers\Api
 *
 * @property User $user
 */
class Controller extends BaseController
{
    use Helpers;

    public $error;

    public function __construct()
    {
        $this->error = new Error();
    }

    public function returnData($data = [])
    {
        return [
            'ret' => 1,
            'data' => $data
        ];
    }

    public function returnError($msg = '', $code = -1)
    {
        return [
            'ret' => -1,
            'code' => $code,
            'msg' => $msg
        ];
    }
}
