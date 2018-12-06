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
//        creating appointments routes
        //    url: localhost:8000/api/v1/appointments
        Route::post('create/walking', 'API\AppoinmentsController@createWalking');
        Route::post('create/request', 'API\AppoinmentsController@createRequst');
        Route::post('create/myguest', 'API\AppoinmentsController@createMyGuest');
    });


    //    url: localhost:8000/api/v1
    Route::group(['prefix' => 'response', 'middleware' => 'auth:api'], function () {
//        creating appointments routes
        //    url: localhost:8000/api/v1/response
        Route::get('my-requests', 'API\ResponseController@showAllPendingRequests');
        Route::get('sent-requests', 'API\ResponseController@showAllSentRequests');
        Route::get('accepted-requests', 'API\ResponseController@showAllAcceptedRequests');
        Route::put('my-requests/update', 'API\ResponseController@updateRequests');
    });

    Route::group(['prefix' => 'assistant', 'middleware' => 'auth:api'], function () {
        Route::get('show-appointments', 'API\AssistantController@showTodaysAppointments');
    });
});
