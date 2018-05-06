<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LikeRequest;
use App\Models\Like;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function create(LikeRequest $request)
    {
        $like = Like::firstOrNew([
            'user_id' => $this->user->id,
            'target_user_id' => $request->target_user_id
        ]);
        $like->type = $request->dislike ? Like::TYPE_DISLIKE : Like::TYPE_LIKE;
        $like->save();
        return $this->returnData();
    }
}
