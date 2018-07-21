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

Route::middleware('api')->get('/user', function (Request $request) {
    //return $request->user();
    return "HI First API";
});

Route::middleware('api')->post('login','User\UserController@login');

Route::group(['middleware' => ['api', 'authCheck']], function()
{
    Route::post('support/history','support\SupportController@history');
    Route::post('support/create','support\SupportController@create');

    Route::middleware('api')->post('parent/add','other\ParentCodeController@add');
    Route::middleware('api')->post('friend/list','other\ParentCodeController@list');    

    
});

Route::middleware('api')->post('apps/list','other\MoreAppsController@list');