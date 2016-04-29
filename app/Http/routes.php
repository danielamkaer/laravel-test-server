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
Route::get('/tests/{test_id}/get_file/{file_id}','TestsController@getFile')->where('test_id','[0-9]+')->where('file_id','[0-9]+');
Route::get('/tests/{test_id}/stdout/{run_id}','TestsController@getStdout')->where('test_id','[0-9]+')->where('run_id','[0-9]+');
Route::get('/tests/{test_id}/stderr/{run_id}','TestsController@getStderr')->where('test_id','[0-9]+')->where('run_id','[0-9]+');

Route::post('/client/begin','ClientController@beginTest');
Route::post('/client/end','ClientController@endTest');
Route::post('/client/stdout','ClientController@postStdout');
Route::post('/client/stderr','ClientController@postStderr');
Route::post('/client/upload_file','ClientController@uploadFile');
Route::get('/client/current','ClientController@currentTest');
Route::get('/client/has_file','ClientController@hasFile');
