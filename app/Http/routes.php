<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test','TestController@req');
Route::get('/test/sample','TestController@gen');

Route::resource('order','OrderController');
Route::group(['prefix' => 'api'],function()
{
    Route::resource('orders','ApiOrderController');
    Route::resource('order_details','ApiOrderDetailsController');
    Route::resource('users','ApiUserController');

    Route::get('/',function(){

        return response()->json(['message' => "welcome to the mps api"],200);
    });
});


