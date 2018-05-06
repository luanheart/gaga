<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Helpers\Weixin\WxBizDataCrypt;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    public function socialStore(SocialAuthorizationRequest $request, $type)
    {
        //获取测试用户token
        if ($request->test_id) {
            $user = User::find($request->test_id);
            $token = Auth::guard('api')->fromUser($user);
            return $this->respondWithToken($token);
        }

        switch ($type) {
            case 'mini_program':
                $user_info = json_decode($request->input('userInfo'), true);
                $client = new Client([
                    'base_uri' => 'https://api.weixin.qq.com',
                    'timeout' => 3,
                    'http_errors' => false
                ]);
                $response = $client->request('GET', '/sns/jscode2session', ['query' => [
                    'appid' => config('weixin.mini_appid'),
                    'secret' => config('weixin.mini_secret'),
                    'js_code' => $request->code,
                    'grant_type' => 'authorization_code'
                ]]);
                $result = json_decode((string)$response->getBody(), true);

                \Log::info(__FUNCTION__, $result);
                if (isset($result['errcode'])) {
                    return $this->returnError($result['errmsg'], $result['errcode']);
                }

                //解密数据获取unionid
                $openid = $result['openid'];
                $unionid = '';
                $decrypt = new WxBizDataCrypt(config('weixin.mini_appid'), $result['session_key']);
                $err_code = $decrypt->decryptData($request->encryptedData, $request->iv, $data);
                if ($err_code == 0) {
                    $data = json_decode($data, true);
                    $unionid = isset($data['unionId']) ? $data['unionId'] : '';
                    $user_info = $data;
                    \Log::info(__FUNCTION__ . '解密数据获取unionid', $data);
                } else {
                    \Log::info(__FUNCTION__ . '解密失败' . $err_code);
                }

                if ($unionid) {
                    $user = User::where('unionid', $unionid)->first();
                } else {
                    $user = User::where('openid', $openid)->first();
                }

                //没有用户，默认创建一个用户
                if (!$user) {
                    $user = User::create([
                        'openid' => $openid,
                        'unionid' => $unionid,
                    ]);
                }
                //更新用户信息
                if (isset($user_info['nickName'])) {
                    $user->nickname = $user_info['nickName'];
                }
                if (isset($user_info['avatarUrl'])) {
                    $user->avatar = $user_info['avatarUrl'];
                }
                $user->save();
                break;
            default:
                return $this->response->errorBadRequest();
        }

        $token = Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        return $this->returnData([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

}
