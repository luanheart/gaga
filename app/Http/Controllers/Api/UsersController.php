<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(Request $request, User $user)
    {
        return $this->returnData(UserTransformer::transform($user, true));
    }

    public function me()
    {
        return $this->returnData(UserTransformer::transform($this->user, true));
    }

    public function update(UserRequest $request)
    {
        $user = $this->user;
        $user->update($request->all());
        return $this->returnData(UserTransformer::transform($user, true));
    }
}
