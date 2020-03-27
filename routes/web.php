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
/*Route::get('/about', function () {
    return view('about');
});*/

Route::group([
    'prefix' => 'news',
    'namespace' => 'News',
    'as' => 'news.'
],

    function () {
        Route::get('/', 'NewsController@index')->name('News');
        Route::get('/{id}/showOne', 'NewsController@showOne')->name('NewsOne');
        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.'
        ], function () {
            Route::get('/', 'CategoriesController@showAll')->name('all');
            Route::get('/{category}', 'CategoriesController@showOne')->name('one');
        });


    });








