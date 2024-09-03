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

Route::middleware('auth:api')->get('/api', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'configs'], function () {
        Route::get('/', 'ServersController@getAllData')->name('configs.all');
    });
    Route::resource('servers', 'ServersController', ['except' => ['show']])->names('servers');

    Route::group(['prefix' => 'servers'], function () {
        Route::get('list-data/{name}', 'ServersController@getListData')->name('servers.list-data');
        Route::get('list-type', 'ServersController@getListType')->name('servers.list-type');
        Route::post('list-db', 'ServersController@getListDB')->name('servers.list-db');
        Route::post('list-table', 'ServersController@getListTable')->name('servers.list-table');

    });

    Route::group(['prefix' => 'systems'], function () {
        Route::post('exec-cmd', 'DBToolController@execCmd')->name('systems.exec-cmd');
        Route::post('exec-func', 'DBToolController@execFunc')->name('systems.exec-func');
        Route::get('hosts', 'DBToolController@getHosts')->name('systems.hosts');
    });

    Route::group(['prefix' => 'services'], function () {
        Route::get('list', 'ServersController@getListService')->name('services.list');
        Route::post('exec-action', 'ServersController@execActionService')->name('services.action');
    });

    Route::group(['prefix' => 'windmill'], function () {
        Route::post('template', 'WindmillController@store')->name('windmill.store');
        Route::post('strategy', 'ServersController@getStrategy')->name('windmill.strategy');
    });

    // Route::get('exec-cmd', '');
    Route::get('config-data', 'ApiController@index');
    Route::get('phasing', 'ApiController@getPhasing');

    Route::put('change-source-url', 'DBToolController@changeSourceUrl')->name('server.change-source-url');
});
