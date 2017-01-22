<?php

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => 'admin'], function() {
        Route::resource('users', 'UsersController');
        Route::resource('tollbooths', 'TollboothsController');
        Route::resource('categories', 'CategoriesController');

        Route::get('distances', 'HomeController@distances');
        Route::post('distances', 'HomeController@updateDistances');

        Route::get('prices/{category_id?}', 'HomeController@prices');
        Route::post('prices/{category_id?}', 'HomeController@updatePrices');
    });

    Route::get('mode', 'HomeController@mode');
    Route::post('mode', 'HomeController@selectMode');

    Route::group(['middleware' => 'mode'], function() {
        Route::get('claim/{id}/download', 'HomeController@downloadClaim');
        Route::get('claim/{id}', 'HomeController@viewClaim');
        Route::post('claim', 'HomeController@claim');

        Route::get('invoice/{id}/download', 'HomeController@downloadInvoice');
        Route::get('invoice/{id}', 'HomeController@viewInvoice');
        Route::post('invoice', 'HomeController@invoice');

        Route::get('/', 'HomeController@index');
    });
});