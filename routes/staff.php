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
Route::group([
    'middleware' => 'checkStaff',
], function(){
    Route::get('/quan-ly-hoc-vien', 'UserController@dashboardStaff')->name('staffs.dashboardStaff');
    Route::group([
        'prefix' => 'lop-hoc',
        'as' => 'classes.'
    ], function() {
        Route::get('/', 'ClassController@index')->name('index');
        Route::get('/tao-lop-hoc', 'ClassController@create')->name('create');
        Route::post('/store', 'ClassController@store')->name('store');
    });

    // ca-hoc
    Route::group(['prefix' => 'ca-hoc'],function(){
        Route::get('/', 'ScheduleController@index')->name('schedule.index');
        Route::get('/tao-ca-hoc', 'ScheduleController@add')->name('schedule.add');
        Route::post('/tao-ca-hoc','ScheduleController@create')->name('schedule.create');
        Route::post('/xoa-ca-hoc','ScheduleController@delete')->name('schedule.delete');
        Route::get('/sua-ca-hoc/{id}','ScheduleController@edit')->name('showschedule.edit');
        Route::post('/sua-ca-hoc/{id}','ScheduleController@update')->name('schedule.edit');
    });

    Route::get('/thong-tin/{id}', 'UserController@getInfoHV')->name('users.getInfoHV');
    Route::post('/store/{id}', 'UserController@store')->name('users.store');
});