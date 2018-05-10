<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\Call;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function dream(Request $request)
    {
        //先随机一个user
        $count = User::count();
        $user_id = rand(1, $count);
        return $this->returnData(UserTransformer::transform(User::find($user_id)));
    }

    public function show(Request $request, User $user)
    {
        //是否显示微信号
        $wechat = Call::isShowWechat($this->user, $user);
        return $this->returnData(UserTransformer::transform($user, true, $wechat));
    }

    public function me()
    {
        return $this->returnData(UserTransformer::transform($this->user, true, true));
    }

    public function update(UserRequest $request)
    {
        $user = $this->user;
        $user->update($request->all());
        return $this->returnData(UserTransformer::transform($user, true, true));
    }
}
