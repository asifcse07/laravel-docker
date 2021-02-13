<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => '/v1', 'middleware' => ['api']], function () {
    Route::post('/ad', array('as' => 'save', 'uses' => 'App\Http\Controllers\ApiAdController@add'));
    Route::post('/ad/edit', array('as' => 'save', 'uses' => 'App\Http\Controllers\ApiAdController@edit'));
    Route::get('/ads', array('as' => 'view', 'uses' => 'App\Http\Controllers\ApiAdController@index'));
    Route::get('/ad/{ad_id}', array('as' => 'view', 'uses' => 'App\Http\Controllers\ApiAdController@view'));
});
