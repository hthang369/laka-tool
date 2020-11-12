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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('login', 'User\UserController@login')->name('user.login');
Route::post('register', 'User\UserController@register')->name('user.register');

Route::group(['prefix' => 'system-admin'], function () {
    // company route
    Route::get('/company', 'Company\CompanyController@index')->name('company.list');
    Route::get('/company/detail/{id}', 'Company\CompanyController@companyDetail')->name('company.detail');
    Route::get('/company/new', 'Company\CompanyController@newForm')->name('company.new');
    Route::get('/company/update/{id}', 'Company\CompanyController@updateForm')->name('company.update');
    // business plan route
    Route::get('/business-plan', 'BusinessPlan\BusinessPlanController@index')->name('business-plan.list');
    Route::get('/business-plan/detail/{id}', 'BusinessPlan\BusinessPlanController@businessDetail')->name('business-plan.detail');
    Route::get('/business-plan/new', 'BusinessPlan\BusinessPlanController@newForm')->name('business-plan.new');
    Route::get('/business-plan/update/{id}', 'BusinessPlan\BusinessPlanController@updateForm')->name('business-plan.update');

    // user management route
    Route::get('user-management', 'User\UserController@index')->name('user-management.list');
    Route::get('user-management/detail/{id}', 'User\UserController@detail')->name('user-management.detail');
    Route::get('user-management/update/{id}', 'User\UserController@updateForm')->name('user-management.update.form');
    Route::post('user-management/update/{id}', 'User\UserController@update')->name('user-management.update');
    Route::get('user-management/new', 'User\UserController@newForm')->name('user-management.new');
    Route::post('user-management/new', 'User\UserController@register')->name('user-management.register');
    Route::get('user-management/delete/{id}', 'User\UserController@delete')->name('user-management.delete');
});
