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

Route::group([
    'middleware' => ['cors']
], function () {
    Route::get('/hello', function () {
        return response()->json(['wwww']);
    });

    // JWT TOKEN
    Route::group([
        'prefix' => 'auth',
    ], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::group(['middleware' => 'jwt'], function () {
            Route::post('logout', 'Api\AuthController@logout');
            Route::post('refresh', 'Api\AuthController@refresh');
            Route::post('me', 'Api\AuthController@me');
        });
    });
});