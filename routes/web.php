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
        Route::get('/index', 'NewsController@index')->name('index');
        Route::get('/show/{news}', 'NewsController@show')->name('show');

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.'
        ], function () {
            Route::get('/index', 'CategoriesController@index')->name('index');
            Route::get('/show/{category}', 'CategoriesController@show')->name('show');
        });


    });

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
],
    function () {
        Route::get('/index', 'IndexController@index')->name('index');
        Route::group([
            'prefix' => 'news',
            'as' => 'news.'
        ], function () {
            Route::get('/index', 'NewsController@index')->name('index');
            Route::get('/create', 'NewsController@create')->name('create');
            Route::post('/create', 'NewsController@store')->name('store');
            Route::get('/edit', 'NewsController@edit')->name('edit');
            Route::get('/show/{news}', 'NewsController@show')->name('show');
            Route::delete( '/delete/{news}', 'NewsController@delete')->name('delete');
            Route::get( '/update/{news}', 'NewsController@editOne')->name('editOne');
            Route::post( '/update/{news}', 'NewsController@update')->name('update');
            Route::match(['get', 'post'], '/export', 'NewsController@export')->name('export');
            Route::group([
                'prefix' => 'categories',
                'as' => 'categories.'
            ], function () {
                Route::get('/index', 'CategoryController@index')->name('index');
                Route::get('/create', 'CategoryController@create')->name('create');
                Route::post('/create', 'CategoryController@store')->name('store');
                Route::get('/edit', 'CategoryController@edit')->name('edit');
                Route::get('/show/{category}', 'CategoryController@show')->name('show');
                Route::delete( '/delete/{category}', 'CategoryController@delete')->name('delete');
                Route::get( '/update/{category}', 'CategoryController@editOne')->name('editOne');
                Route::post( '/update/{category}', 'CategoryController@update')->name('update');
            });
        });
    });


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
