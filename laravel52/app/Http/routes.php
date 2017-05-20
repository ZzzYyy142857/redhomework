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

Route::any('/test', function () {
    return 'hello world';
});

Route::any('/{id}', 'UserController@judgeInfo')->middleware('old');

//Route::group(['prefix' => 'web'], function (
//    路由));

//Route::any('/test','xxx/xxx/xxx@xxx')
//@方法

/*Route::any('/test/{id}', function($id) {
    return $id;
});*/

//Route::any('/studentinfo', 'firsttestController@studinfo');
