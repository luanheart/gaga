<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings']
], function($api) {
    $api->group([], function ($api) {
        // 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore');

        $api->group(['middleware' => 'api.auth'], function ($api) {

            $api->get('user/dream', 'UsersController@dream'); //下一个

            $api->get('user/{user}', 'UsersController@show'); //查看用户信息
            // 当前登录用户信息
            $api->get('user', 'UsersController@me');
            $api->patch('user', 'UsersController@update');
            $api->post('user/tags', 'UserTagsController@create');

            $api->post('calls', 'CallsController@create'); //交换微信号
            $api->post('likes', 'LikesController@create'); //喜欢
            $api->post('collections', 'CollectionsController@create'); //收藏
            $api->post('hearts', 'HeartsController@create'); //点赞/发射小心心

            $api->get('collections', 'CollectionsController@index'); //收藏列表

            $api->post('reports', 'ReportsController@create'); //举报
        });
    });
});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth.administrator', 'serializer:array', 'bindings']
], function($api) {
    $api->group(['prefix' => 'admin'], function ($api) {

        //登录
        $api->post('login', 'AdministratorsController@login');

        $api->group(['middleware' => 'api.auth'], function ($api) {
            //管理员相关
            $api->get('administrators', 'AdministratorsController@index');
            $api->post('administrators', 'AdministratorsController@store');
            $api->patch('administrators/{administrator}', 'AdministratorsController@update');
            $api->delete('administrators/{administrator}', 'AdministratorsController@destroy');

            //tag 相关
            $api->get('tags', 'TagsController@index');
            $api->post('tags', 'TagsController@store');
            $api->patch('tags/{tag}', 'TagsController@update');
            $api->delete('tags/{tag}', 'TagsController@destroy');
            $api->get('tag_types', 'TagTypesController@index');
            $api->post('tag_types', 'TagTypesController@store');
            $api->patch('tag_types/{tag_type}', 'TagTypesController@update');
            $api->delete('tag_types/{tag_type}', 'TagTypesController@destroy');

            //user 相关
            $api->get('users', 'UsersController@index');
            $api->patch('users/{user}', 'UsersController@udpate');

            //举报相关
            $api->get('reports', 'ReportsController@index');
            $api->patch('reports/{report}', 'ReportsController@update');
        });
    });
});