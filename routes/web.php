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
        Route::get('showOne/{id}/', 'NewsController@show')->name('show');

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.'
        ], function () {
            Route::get('/', 'CategoriesController@index')->name('index');
            Route::get('/{category}', 'CategoriesController@showOne')->name('show');
        });


    });

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
],
    function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::group([
            'prefix' => 'news',
            'as' => 'news.'
        ], function () {
            Route::get('/', 'NewsController@index')->name('index');
            Route::get('show/{id}/', 'NewsController@show')->name('show');
            Route::match(['get', 'post'], '/create', 'NewsController@create')->name('create');
            Route::match(['get', 'post'], '/download', 'NewsController@download')->name('download');
            Route::match(['get', 'post'], '/delete/{id}', 'NewsController@delete')->name('delete');
            Route::group([
                'prefix' => 'categories',
                'as' => 'categories.'
            ], function () {
                Route::get('/', 'CategoryController@index')->name('index');
                Route::get('/show/{category}', 'CategoryController@showOne')->name('show');
                Route::match(['get', 'post'], '/create', 'CategoryController@create')->name('create');
                Route::match(['get', 'post'], '/delete/{id}', 'CategoryController@delete')->name('delete');
            });
        });
    });


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
