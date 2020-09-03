<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::name('blog.')->group(function () {
    Route::get('/', 'ArticleController@index')->name('index');
});
