<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'v1'], function () {

//url: localhost:8000/api/v1/user
    Route::group(['prefix' => 'user'], function () {

        Route::post('login', 'API\UserController@login');
        Route::post('register', 'API\UserController@register');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('details', 'API\UserController@details');
            Route::get('logout', 'API\UserController@logout');
            Route::get('users', 'API\UserController@getAllUsers');
        });
    });

//url: localhost:8000/api/v1/appointments/create
    Route::group(['prefix' => 'appointments/create', 'middleware' => 'auth:api'], function () {

        Route::post('walking', 'API\AppoinmentsController@createWalking');
        Route::post('request', 'API\AppoinmentsController@createRequest');
        Route::post('myguest', 'API\AppoinmentsController@createMyGuest');
    });

//    url: localhost:8000/api/v1/appointments/edit
    Route::group(['prefix' => 'appointments/edit', 'middleware' => 'auth:api'], function () {

        Route::put('request', 'API\AppoinmentsController@editRequest');
        Route::put('myguest', 'API\AppoinmentsController@editMyGuest');
    });

    //    url: localhost:8000/api/v1/appointments/delete
    Route::group(['prefix' => 'appointments/delete', 'middleware' => 'auth:api'], function () {

        Route::delete('request', 'API\AppoinmentsController@deleteRequest');
    });


//url: localhost:8000/api/v1/response
    Route::group(['prefix' => 'response', 'middleware' => 'auth:api'], function () {

        Route::get('my-requests', 'API\ResponseController@showAllPendingRequests');
        Route::get('sent-requests', 'API\ResponseController@showAllSentRequests');
        Route::get('accepted-requests', 'API\ResponseController@showAllAcceptedRequests');
        Route::put('my-requests/update', 'API\ResponseController@updateRequests');
    });

//url: localhost:8000/api/v1/assistant
    Route::group(['prefix' => 'assistant', 'middleware' => 'auth:api'], function () {

        Route::get('show-todays-appointments', 'API\AssistantController@showTodaysAppointments');
    });
});
