<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/getQSize', function () {
    return response()->json(['status'=>'ok', 'size' => Queue::size('default')], JSON_UNESCAPED_UNICODE);
})->middleware('api');
