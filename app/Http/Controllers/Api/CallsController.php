<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CallRequest;
use App\Models\Call;

class CallsController extends Controller
{

    //交换微信号
    public function create(CallRequest $request, Call $call)
    {
        $has_call = Call::where('user_id', $this->user->id)
            ->where('target_user_id', $request->target_user_id)
            ->first();
        if ($has_call) {
            return $this->response->error('已申请交换', 200);
        }

        $call->fill([
            'user_id' => $this->user->id,
            'target_user_id' => $request->target_user_id
        ]);
        $call->save();
        return $this->returnData();
    }
}
