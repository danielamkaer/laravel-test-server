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

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('/tests','TestsController');

Route::post('/client/begin','ClientController@beginTest');
Route::post('/client/end','ClientController@endTest');
Route::post('/client/stdout','ClientController@postStdout');
Route::post('/client/stderr','ClientController@postStderr');
Route::post('/client/upload_file','ClientController@uploadFile');
Route::get('/client/current','ClientController@currentTest');
