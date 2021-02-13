<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/add',array('as'=>'home', 'uses' =>'App\Http\Controllers\AdController@home'));
Route::get('/edit/{ad_id}',array('as'=>'home', 'uses' =>'App\Http\Controllers\AdController@show'));
Route::get('/',array('as'=>'index', 'uses' =>'App\Http\Controllers\AdController@index'));
Route::get('/delete/{image_id}',array('as'=>'delete', 'uses' =>'App\Http\Controllers\AdController@deleteImage'));
