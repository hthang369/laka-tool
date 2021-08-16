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

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', function () {
    return redirect('system-admin/version');
});

Route::group(['middleware' => ['log-activity']], function() {
    Auth::routes();
});

Route::get('research-list', 'ResearchLaravel\ResearchLaravelController@list');

Route::group(['prefix' => 'system-admin', 'middleware' => ['auth:web', 'permission', 'log-activity']], function () {
    Route::get('confirm-dialog/{id}', 'Commons\CommonController@confirmDialog')->name('common.confirm');
    // version route
    Route::get('version', 'Versions\VersionController@index')->name('version.index');//->middleware("log.activity:Version index");
    // company route
    Route::resource('company', 'Companys\CompanyController');
    // business plan
    Route::resource('bussiness-plan', 'BusinessPlans\BusinessPlanController', ['parameters' => ['bussiness-plan' => 'id']]);
    // role management
    Route::resource('role', 'Roles\RoleController')->names('role-management');
    Route::get('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@showByRole')->name('permission-role.show');
    Route::put('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@update')->name('permission-role.update');

    // user management
    Route::resource('user-management', 'Users\UserController');

    // laka-user-management
    Route::resource('laka-user-management', 'LakaUsers\LakaUserController', ['except' => ['show', 'update', 'destroy', 'edit']]);
    Route::group(['prefix' => 'laka-user-management'], function () {
        Route::get('user-disable', 'LakaUsers\LakaUserController@showUserDisable')->name('laka-user-management.user-disable');
        Route::get('add-contact', 'LakaUsers\LakaUserController@showAddContact')->name('laka-user-management.add-contact');
        Route::get('update-contact/{id}', 'LakaUsers\LakaUserController@show')->name('laka-user-management.edit');
        Route::post('update-contact/{id}', 'LakaUsers\LakaUserController@update')->name('laka-user-management.update');
        Route::post('disable-user/{id}', 'LakaUsers\LakaUserController@disableUser')->name('laka-user-management.disable-user');

    });

    // Version deploy
    Route::group(['prefix' => 'deploy'], function () {
        Route::get('/development', 'Deploys\DeployController@index')->name('version-deploy.development');//->middleware("log.activity:Version Deploy");
        Route::get('/staging', 'Deploys\DeployController@index')->name('version-deploy.staging');//->middleware("log.activity:Version Deploy");
        Route::get('/production', 'Deploys\DeployController@index')->name('version-deploy.production');//->middleware("log.activity:Version Deploy");
        Route::post('deploy', 'Deploys\DeployController@doDeploy')->name('version-deploy.deploy');
        // Route log-release
        Route::group(['prefix' => 'log-release'], function () {
            Route::get('/', 'LogReleases\LogReleaseController@index')->name('version-deploy.log-release');
            // Route::get('search-log',[App\Http\Controllers\LogRelease\LogReleaseController::class,'searchLogRelease'])->name('Version Deploy.Deploy index.Search LogRelease');
            // Route::get('/{user_id}', [App\Http\Controllers\LogRelease\LogReleaseController::class, 'getLogReleaseByUserId'])->name('Version Deploy.Deploy index.Show Log Release By User Id');
        });
    });

    // laka log route
    Route::resource('laka-log', 'LakaLogs\LakaLogController');
});
