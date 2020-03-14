<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'TasksController@index')->name('home');

    Route::group(['prefix' => 'buttons'], function () {
        Route::post('/', 'ButtonController@createOrUpdate');
        Route::delete('/', 'ButtonController@delete');
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::post('/others', 'TasksController@list');
        Route::post('/', 'TasksController@createOrUpdate');
        Route::delete('/', 'TasksController@delete');
    });

    Route::group(['prefix' => 'flows'], function () {
        Route::get('/', 'FlowsController@index')->name('flows');
        Route::post('/next', 'FlowsController@update');
        Route::post('/', 'FlowsController@create');
        Route::get('/list', 'FlowsController@list')->name('list');
        Route::post('/tasks', 'FlowsController@getTasks');
    });
});
