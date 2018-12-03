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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1'], function () {

//    url: localhost:8000/api/v1
    Route::group(['prefix' => 'user'], function () {
        //Authentication Route
        //    url: localhost:8000/api/v1/user
        Route::post('login', 'API\UserController@login');
        Route::post('register', 'API\UserController@register');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('details', 'API\UserController@details');
            Route::get('logout', 'API\UserController@logout');
            Route::post('users', 'API\UserController@getAllUsers');
        });
    });

//    url: localhost:8000/api/v1
    Route::group(['prefix' => 'appointments', 'middleware' => 'auth:api'], function () {
        //    url: localhost:8000/api/v1/appointments
        Route::post('create', 'API\AppoinmentsController@create');
    });
});
