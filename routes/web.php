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
Route::get('/auth/{socialNetwork}', 'LoginController@login')->name('loginSocial');
Route::get('/auth/{socialNetwork}/response', 'LoginController@response')->name('responseSocial');
Route::group([
    'prefix' => 'profile',
    'as' => 'profile.',
    'middleware'=> 'auth'
], function () {
    Route::get('/', 'ProfileController@edit')->name('edit');
    Route::put('/', 'ProfileController@update')->name('update');
});
Auth::routes();
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
/*
|--------------------------------------------------------------------------
|Admin
|--------------------------------------------------------------------------
|   Routes for the admin functionality
|
*/
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware'=>['auth','is_admin']
],
    function () {
        Route::get('/index', 'IndexController@index')->name('index');
        Route::get('/parser', 'ParseController@index')->name('parser');
        Route::group([
            'prefix' => 'news',
            'as' => 'news.'
        ], function () {
            Route::get('/export', 'NewsController@export')->name('export');
            Route::post('/export', 'NewsController@exportRespond')->name('export');
        });
        Route::resources([
            'news' => 'NewsController',
            'category' => 'CategoryController',
            'resource'=>'ResourseController'
        ]);

        Route::group([
            'prefix' => 'users',
            'as' => 'users.'
        ], function () {
            Route::get('/edit', 'ProfileController@edit')->name('edit');
            Route::put('/update/{user}', 'ProfileController@update')->name('update');
        });

    });




