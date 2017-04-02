<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    $tasks = \App\Task::all();

    return View::make('welcome')->with('tasks',$tasks);
});

Route::get('fileentry', 'FileEntryController@index');

Route::get('fileentry/get/{filename}', [
    'as' => 'getentry', 'uses' => 'FileEntryController@get']);

Route::post('fileentry/add',[
    'as' => 'addentry', 'uses' => 'FileEntryController@add']);
