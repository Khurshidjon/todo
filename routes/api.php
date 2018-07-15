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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'api'], function (){
    Route::get('/home', 'API\ApiController@page')->name('api.page');

/*Authorized*/

    Route::post('/posts/register', 'API\ApiController@register')->middleware('auth:api');
    Route::post('/posts/login', 'API\ApiController@login')->middleware('auth:api');
    Route::post('/posts/logout', 'API\ApiController@logout')->middleware('auth:api');

/*End Authorized*/

    Route::resource('posts', 'API\ApiController');
});