<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LikeRequest;
use App\Http\Requests\Api\UserTagRequest;
use App\Models\Like;
use App\Models\Tag;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserTagsController extends Controller
{
    public function create(UserTagRequest $request)
    {
        $tag_ids = json_decode($request->tag_ids, true);
        $dream_ids = json_decode($request->dream_ids, true);


        $user = $this->user;
        if ($tag_ids) {
            if (!is_array($tag_ids) || count($tag_ids) !== Tag::whereIn('id', $tag_ids)->count()) {
                return $this->response->error('tag_ids 不合法', 422);
            }
            $user->tags()->detach();
            $user->tags()->attach($tag_ids);
        }

        if ($dream_ids) {
            if (!is_array($dream_ids) || count($dream_ids) !== Tag::whereIn('id', $dream_ids)->count()) {
                return $this->response->error('dream_ids 不合法', 422);
            }
            $user->dreams()->detach();
            $user->dreams()->attach($dream_ids);
        }

        return $this->response->noContent();
    }
}
