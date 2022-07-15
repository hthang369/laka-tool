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
    // role management
    Route::resource('role', 'Roles\RoleController')->names('role-management');
    Route::get('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@showByRole')->name('permission-role.edit');
    Route::post('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@update')->name('permission-role.update');

    // user management
    Route::group(['prefix' => 'user-management'], function () {
        Route::get('update-password', 'Users\UserController@showUpdatePassword')->name('user-management.update-password-form');
        Route::put('update-password', 'Users\UserController@updatePassword')->name('user-management.update-password');
    });
    Route::resource('user-management', 'Users\UserController');
    Route::resource('log-activity', 'LogActivity\LogActivityController');
});
