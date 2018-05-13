<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CollectionRequest;
use App\Models\Collection;
use App\Models\Heart;
use App\Models\Like;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class HeartsController extends Controller
{

    public function create(CollectionRequest $request, Heart $heart)
    {

        $target_user_id = $request->target_user_id;

        if (Heart::where('user_id', $this->user->id)->where('target_user_id', $target_user_id)->first()) {
            return $this->returnError('已经点过赞了');
        }

        //TODO 检查次数限制，每天只有5次机会
        $max = 5;
        $count = Heart::where('user_id', $this->user->id)->where('created_at', '>', date('Y-m-d'))->count();
        if ($count >= $max) {
            return $this->returnError("每天最多发射{$max}次");
        }

        $heart->fill([
            'user_id' => $this->user->id,
            'target_user_id' => $target_user_id
        ]);
        $heart->save();

        return $this->returnData();
    }
}
