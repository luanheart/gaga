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
            $api->get('user/{user}', 'UsersController@show');
            // 当前登录用户信息
            $api->get('user', 'UsersController@me');
            $api->patch('user', 'UsersController@update');
            $api->post('user/tags', 'UserTagsController@create');

            $api->post('calls', 'CallsController@create');

            $api->post('likes', 'LikesController@create');
            $api->post('collections', 'CollectionsController@create');
            $api->get('collections', 'CollectionsController@index');

            $api->post('reports', 'ReportsController@create');
        });
    });
});