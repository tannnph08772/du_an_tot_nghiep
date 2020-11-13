<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/index', 'UserController@dsCho')->name('users.index');
Route::get('/thong-tin/{id}', 'UserController@getInfoHV')->name('users.getInfoHV');
Route::post('/store/{id}', 'UserController@store')->name('users.store');
