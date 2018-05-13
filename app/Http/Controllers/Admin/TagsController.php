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
        $tags = $query->with('typeName')->paginate($request->input('per_page', 20));
        $data = [];
        foreach ($tags as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->name,
                'type' => $item->type,
                'type_name' => $item->typeName ? $item->typeName->type_name : '',
                'created_at' => (string)$item->created_at
            ];
        }

        return $this->returnPaginator($tags, $data);
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
