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
    // business plan
    Route::resource('bussiness-plan', 'BusinessPlans\BusinessPlanController', ['parameters' => ['bussiness-plan' => 'id']]);

    // company route
    Route::resource('company', 'Companys\CompanyController');

    // laka-user-management
    Route::resource('laka-user-management', 'LakaUsers\LakaUserController', ['except' => ['show', 'store', 'update', 'destroy', 'edit']]);
    Route::group(['prefix' => 'laka-user-management'], function () {
        Route::get('laka-user-management', 'LakaUsers\LakaUserController@create')->name('laka-user-company.create');
        Route::post('laka-user-management', 'LakaUsers\LakaUserController@store')->name('laka-user-company.store');
        Route::get('user-disable', 'LakaUsers\LakaUserController@showUserDisable')->name('laka-user-disable.user-disable');
        Route::get('add-contact', 'LakaUsers\LakaUserController@showAddContact')->name('laka-user-company.add-contact');
        Route::get('update-contact/{id}', 'LakaUsers\LakaUserController@show')->name('laka-user-management.edit');
        Route::put('update-contact/{id}', 'LakaUsers\LakaUserController@update')->name('laka-user-management.update');
        Route::get('disable-user/{id}', 'LakaUsers\LakaUserController@disableUser')->name('laka-user-management.disable-user');
        Route::post('disable-user/{id}', 'LakaUsers\LakaUserController@checkVerificationCode')->name('laka-user-management.check-verification-code');
        Route::post('resend-code/{id}', 'LakaUsers\LakaUserController@resendVerificationCode')->name('laka-user-management.resend-code');
        Route::post('reset-password/{id}', 'LakaUsers\LakaUserController@resetPassword')->name('laka-user-management.reset-password');
        Route::group(['prefix'=>'approval-api-token'],function(){
            Route::post('/approval-token/{id}','LakaUsers\LakaUserController@approvalToken')->name('laka-user-management.approval-token');
            Route::post('/stop-token/{id}','LakaUsers\LakaUserController@stopToken')->name('laka-user-management.stop-token');
            Route::delete('/delete-token/{id}','LakaUsers\LakaUserController@destroy')->name('laka-user-management.delete-token');
        });
    });

    // Version deploy
    Route::group(['prefix' => 'deploy'], function () {
        Route::get('/development', 'Deploys\DeployController@index')->name('deploy-development.development');//->middleware("log.activity:Version Deploy");
        Route::get('/staging', 'Deploys\DeployController@index')->name('deploy-staging.staging');//->middleware("log.activity:Version Deploy");
        Route::get('/production', 'Deploys\DeployController@index')->name('deploy-production.production');//->middleware("log.activity:Version Deploy");
        Route::post('deploy-version','Deploys\DeployController@doDeploy')->name('version-deploy.deploy');
        // Route log-release
        Route::group(['prefix' => 'log-release'], function () {
            Route::get('/', 'LogReleases\LogReleaseController@index')->name('version-deploy.log-release');
            // Route::get('search-log',[Modules\LakaManager\Http\Controllers\LogRelease\LogReleaseController::class,'searchLogRelease'])->name('Version Deploy.Deploy index.Search LogRelease');
            // Route::get('/{user_id}', [Modules\LakaManager\Http\Controllers\LogRelease\LogReleaseController::class, 'getLogReleaseByUserId'])->name('Version Deploy.Deploy index.Show Log Release By User Id');
        });
    });

    // laka log route
    Route::group(['prefix' => 'laka-log'], function () {
        Route::get('/s3-log-list', 'LakaLogs\AwsS3LogController@view')->name('laka-log-s3.s3-log-list');
        Route::post('/download-log', 'LakaLogs\AwsS3LogController@downloadLog')->name('laka-log-s3.download-log');
        Route::resource('/parse-log', 'LakaLogs\LakaParseLogController', ['only' => ['index', 'store']])->names('laka-parse-log');
    });
    Route::resource('laka-log', 'LakaLogs\LakaLogController', ['except' => ['create', 'store']]);

    // repair data
    Route::resource('repair-data', 'RepairDatas\RepairDataController', ['except' => ['show', 'create', 'destroy']]);
    Route::group(['prefix' => 'repair-data'], function () {
        Route::post('/download', 'RepairDatas\RepairDataController@downloadData')->name('repair-data.download');
        Route::post('/restore', 'RepairDatas\RepairDataController@restoreDataRedis')->name('repair-data.restore');
    });
});
