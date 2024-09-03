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

Route::group(['prefix' => '', 'middleware' => ['auth:web', 'permission', 'log-activity']], function () {
    Route::resource('sites', 'SiteController');
    Route::resource('servers', 'InstanceController', ['only' => ['index', 'show']]);
    Route::resource('hosts', 'HostController');
    Route::group(['prefix' => 'servers'], function () {
        Route::get('start/{name}', 'InstanceController@start')->name('servers.start');
        Route::get('stop/{name}', 'InstanceController@stop')->name('servers.stop');
        Route::get('restart/{name}', 'InstanceController@restart')->name('servers.restart');
    });
});
