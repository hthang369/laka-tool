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

use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

// Route::get('/', function () {
//     return redirect('system-admin/version');
// });

Route::get('/storage/files/{folder}/{name}', function ($folder, $name) {
    return Storage::disk('local')->download('public/files/' . $folder . '/' . $name);
});

Route::group(['middleware' => ['log-activity']], function () {
    Auth::routes();
});

Route::group(['prefix' => 'system-admin', 'middleware' => ['auth:web', 'permission', 'log-activity']], function () {
    Route::get('confirm-dialog/{id}', 'Commons\CommonController@confirmDialog')->name('common.confirm');
    // version route
    Route::get('version', 'Versions\VersionController@index')->name('version.index');//->middleware("log.activity:Version index");




});
