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

Route::get('/', function () {
    return redirect('system-admin/version');
});

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
    // company route
    Route::resource('company', 'Companys\CompanyController');
    // business plan
    Route::resource('bussiness-plan', 'BusinessPlans\BusinessPlanController', ['parameters' => ['bussiness-plan' => 'id']]);
    // role management
    Route::resource('role', 'Roles\RoleController')->names('role-management');
    Route::get('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@showByRole')->name('permission-role.show');
    Route::put('role/set-permission/{id}', 'RoleHasPermissions\RoleHasPermissionController@update')->name('permission-role.update');

    // user management
    Route::group(['prefix' => 'user-management'], function () {
        Route::get('update-password', 'Users\UserController@showUpdatePassword')->name('user-management.update-password-form');
        Route::put('update-password', 'Users\UserController@updatePassword')->name('user-management.update-password');
    });
    Route::resource('user-management', 'Users\UserController');

    // laka-user-management
    Route::resource('laka-user-management', 'LakaUsers\LakaUserController', ['except' => ['show', 'update', 'destroy', 'edit']]);
    Route::group(['prefix' => 'laka-user-management'], function () {
        Route::get('user-disable', 'LakaUsers\LakaUserController@showUserDisable')->name('laka-user-management.user-disable');
        Route::get('add-contact', 'LakaUsers\LakaUserController@showAddContact')->name('laka-user-management.add-contact');
        Route::get('update-contact/{id}', 'LakaUsers\LakaUserController@show')->name('laka-user-management.edit');
        Route::post('update-contact/{id}', 'LakaUsers\LakaUserController@update')->name('laka-user-management.update');
        Route::get('disable-user/{id}', 'LakaUsers\LakaUserController@disableUser')->name('laka-user-management.disable-user');
        Route::post('disable-user/{id}', 'LakaUsers\LakaUserController@checkVerificationCode')->name('laka-user-management.check-verification-code');
        Route::get('reset-password/{id}', 'LakaUsers\LakaUserController@resetPassword')->name('laka-user-management.reset-password');

    });

    // Version deploy
    Route::group(['prefix' => 'deploy'], function () {
        Route::get('/development', 'Deploys\DeployController@index')->name('version-deploy.development');//->middleware("log.activity:Version Deploy");
        Route::get('/staging', 'Deploys\DeployController@index')->name('version-deploy.staging');//->middleware("log.activity:Version Deploy");
        Route::get('/production', 'Deploys\DeployController@index')->name('version-deploy.production');//->middleware("log.activity:Version Deploy");
        Route::middleware('log-release')->post('deploy','Deploys\DeployController@doDeploy')->name('version-deploy.deploy');
        // Route log-release
        Route::group(['prefix' => 'log-release'], function () {
            Route::get('/', 'LogReleases\LogReleaseController@index')->name('version-deploy.log-release');
            // Route::get('search-log',[App\Http\Controllers\LogRelease\LogReleaseController::class,'searchLogRelease'])->name('Version Deploy.Deploy index.Search LogRelease');
            // Route::get('/{user_id}', [App\Http\Controllers\LogRelease\LogReleaseController::class, 'getLogReleaseByUserId'])->name('Version Deploy.Deploy index.Show Log Release By User Id');
        });
    });

    // laka log route
    Route::group(['prefix' => 'laka-log'], function () {
        Route::get('/s3-log-list', 'LakaLogs\AwsS3LogController@view')->name('laka-log.s3-log-list');
        Route::post('/download-log', 'LakaLogs\DownloadLakaLogController@downloadLog')->name('laka-log.download-log');
    });
    Route::resource('laka-log', 'LakaLogs\LakaLogController');

    // repair data
    Route::resource('repair-data', 'RepairDatas\RepairDataController', ['except' => ['show', 'create', 'destroy', 'store']]);
    Route::post('run-test', 'RepairDatas\RepairDataController@runTest')->name('repair-data.test');
});
