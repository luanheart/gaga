<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Requests\Admin\UsersRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request, User $user)
    {
        $query = $user->query();

        if ($nickname = $request->nickname) {
            $query->where('nickname', 'like', "%$nickname%");
        }
        if ($wechat = $request->wechat) {
            $query->where('wechat', $wechat);
        }
        if (isset($request->status)) {
            $query->where('status', $request->status);
        }
        $users = $query->paginate($request->input('per_page', 20));

        return $this->returnPaginator($users, $users->items());
    }

    public function udpate(UsersRequest $request, User $user)
    {
        $user->status = $request->status;
        $user->save();
        return $this->returnData();
    }
}
