<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/{locale?}', function () {
    return view('public.index');
})->name('home');

Route::get('/{locale}/profile', function () {
    return view('public.profile');
})->name('profile');

Route::get('/{locale}/view_history', function () {
    return view('public.view_history');
})->name('profile.view_history');

Route::group([
    'middleware' => 'auth',
    'prefix' => '/{locale}/cms',

], function () {
    Route::get('', function () {
        return view('cms.index');
    })->name('cms');

    Route::get('/cms/settings', function () {
        return view('cms.settings.index');
    })->name('cms.settings.index');

    Route::get('/cms/feedbacks', function () {
        return view('cms.feedbacks.index');
    })->name('cms.feedbacks.index');
});

$cmsRouteService = app(App\Services\Routes\Providers\Cms\CmsRoutesProvider::class);
$publicRouteService = app(\App\Services\Routes\Providers\Public\PublicRoutesProvider::class);

$cmsRouteService->registerRoutes();
$publicRouteService->registerRoutes();

