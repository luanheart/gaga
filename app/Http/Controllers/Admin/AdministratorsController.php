<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdministratorRequest;
use Auth;
use App\Http\Controllers\Api\AuthorizationsController;
use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorsController extends AuthorizationsController
{

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (!$username || !$password) {
            return $this->returnError('请输入用户名或密码');
        }

        if (!$admin = Administrator::where('username', $username)->first()) {
            return $this->returnError('用户名不存在');
        }
        if ($admin->password != md5($password)) {
            return $this->returnError('密码错误');
        }
        $token = Auth::guard('api')->fromUser($admin);
        return $this->respondWithToken($token);
    }

    public function index(Request $request)
    {
        $per_page = $request->per_page ?: 20;
        $administrators_list = Administrator::paginate($per_page);

        return $this->returnPaginator($administrators_list, $administrators_list->items());
    }

    public function store(AdministratorRequest $request, Administrator $administrator)
    {
        $administrator->fill($request->all());
        $administrator->password = md5($request->password);
        $administrator->save();

        return $this->returnData();
    }

    public function update(AdministratorRequest $request,Administrator $administrator){

        $administrator->password = md5($request->password);
        $administrator->update();

        return $this->returnData();
    }

    public function destroy(AdministratorRequest $request,Administrator $administrator){
        $administrator->delete();

        return $this->returnData();
    }
}
