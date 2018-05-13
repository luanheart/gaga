<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request, Tag $tag)
    {
        $query = $tag->query();

        if ($name = $request->name) {
            $query->where('name', 'like', "%$name%");
        }
        if ($type = $request->type) {
            $query->where('type', $type);
        }
        $tags = $query->paginate($request->input('per_page', 20));

        return $this->returnPaginator($tags, $tags->items());
    }

    public function store(TagRequest $request, Tag $tag)
    {
        $tag->fill($request->all());
        $tag->save();
        return $this->returnData();
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->all());
        return $this->returnData();
    }

    public function destroy(Request $request, Tag $tag)
    {
        $tag->delete();
        return $this->returnData();
    }
}
