<?php

use App\News\Category;

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

Route::get('/', 'HomeController@index')->name('Home');
/*
|--------------------------------------------------------------------------
|News
|--------------------------------------------------------------------------
|   Routes for the news functionality
|
*/
Route::group([
    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'
],
    function () {
        Route::get('/', 'NewsController@index')->name('index');
        Route::get('showOne/{id}/', 'NewsController@showOne')->name('show');

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.'
        ], function () {
            Route::get('/', 'CategoriesController@index')->name('index');
            Route::get('/{category}', 'CategoriesController@showOne')->name('show');
        });


    });








