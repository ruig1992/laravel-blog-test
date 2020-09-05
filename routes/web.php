<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::name('blog.')->group(function () {
    Route::get('/', 'ArticleController@index')->name('index');
    Route::get('/{slug}', 'ArticleController@show')->name('show');

    Route::get('/category/{slug}', 'ArticleController@byCategory')->name('indexByCategory');
});

Route::middleware('auth')
    ->prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', 'ProfileController@index')->name('dashboard');

        Route::resource('articles', 'ArticleController');
    });
