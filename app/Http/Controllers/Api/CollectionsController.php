<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CollectionRequest;
use App\Models\Collection;
use App\Models\Like;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index(Request $request)
    {
        $collections = $this->user->collections()
            ->orderBy('collections.created_at', 'desc')
            ->paginate(20);
        return $this->returnPaginator($collections, UserTransformer::transformCollection($collections->items()));
    }

    public function create(CollectionRequest $request)
    {
        $like = Collection::firstOrNew([
            'user_id' => $this->user->id,
            'target_user_id' => $request->target_user_id
        ]);
        if ($request->cancel) {
            $like->delete();
        } else {
            $like->save();
        }
        return $this->returnData();
    }
}
