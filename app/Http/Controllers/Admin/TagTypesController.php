<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Requests\Admin\TagTypeRequest;
use App\Models\TagType;
use Illuminate\Http\Request;

class TagTypesController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->per_page ?: 20;
        $tag_types = TagType::paginate($per_page);
        return $this->returnPaginator($tag_types, $tag_types->items());
    }

    public function store(TagTypeRequest $request, TagType $tag_type)
    {
        $tag_type->fill($request->all());
        $tag_type->save();
        return $this->returnData();
    }

    public function update(TagTypeRequest $request, TagType $tag_type)
    {
        $tag_type->update($request->all());
        return $this->returnData();
    }

    public function destroy(Request $request, TagType $tag_type)
    {
        $tag_type->delete();
        return $this->returnData();
    }
}
