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

Route::prefix('docs')->group(function() {

    Route::get('/', 'DocumentsController@index')->name('docs.index');
    Route::prefix('components')->group(function () {
        Route::get('/', 'Components\ComponentsController@index')->name('components.index');
        Route::resource('alerts', 'Components\AlertController', ['only' => ['index']])->names('components.alerts');
        Route::resource('badge', 'Components\BadgeController', ['only' => ['index']])->names('components.badge');
        Route::resource('breadcrumb', 'Components\BreadcrumbController', ['only' => ['index']])->names('components.breadcrumb');
        Route::resource('button', 'Components\ButtonController', ['only' => ['index']])->names('components.button');
        Route::resource('card', 'Components\CardController', ['only' => ['index']])->names('components.card');
        Route::resource('carousel', 'Components\CarouselController', ['only' => ['index']])->names('components.carousel');
        Route::resource('embed', 'Components\EmbedController', ['only' => ['index']])->names('components.embed');
        Route::resource('headline', 'Components\HeadlineController', ['only' => ['index']])->names('components.headline');
        Route::resource('form', 'DocumentsController', ['only' => ['index']])->names('components.form');
        Route::resource('form-checkbox', 'DocumentsController', ['only' => ['index']])->names('components.form-checkbox');
        Route::resource('form-datepicker', 'DocumentsController', ['only' => ['index']])->names('components.form-datepicker');
        Route::resource('form-file', 'DocumentsController', ['only' => ['index']])->names('components.form-file');
        Route::resource('form-group', 'DocumentsController', ['only' => ['index']])->names('components.form-group');
        Route::resource('form-input', 'DocumentsController', ['only' => ['index']])->names('components.form-input');
        Route::resource('form-radio', 'DocumentsController', ['only' => ['index']])->names('components.form-radio');
        Route::resource('form-select', 'DocumentsController', ['only' => ['index']])->names('components.form-select');
        Route::resource('form-textarea', 'DocumentsController', ['only' => ['index']])->names('components.form-textarea');
        Route::resource('image', 'Components\ImageController', ['only' => ['index']])->names('components.image');
        Route::resource('link', 'Components\LinkController', ['only' => ['index']])->names('components.link');
        Route::resource('media', 'Components\MediaController', ['only' => ['index']])->names('components.media');
        Route::resource('modal', 'Components\ModalController', ['only' => ['index']])->names('components.modal');
        Route::resource('progress', 'Components\ProgressController', ['only' => ['index']])->names('components.progress');
        Route::resource('stripe-nav', 'DocumentsController', ['only' => ['index']])->names('components.stripe-nav');
        Route::resource('svg', 'DocumentsController', ['only' => ['index']])->names('components.svg');
        Route::resource('toasts', 'Components\ToastsController', ['only' => ['index']])->names('components.toasts');
    });
    Route::prefix('layout')->group(function () {
        Route::resource('row', 'DocumentsController', ['only' => ['index']])->names('layout.row');
        Route::resource('col', 'DocumentsController', ['only' => ['index']])->names('layout.col');
    });
});
