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
    'middleware' => 'checkTeacher',
], function(){
    Route::get('giang-vien/dashboard', 'UserController@dashboardTeacher')->name('teachers.dashboardTeacher');
    Route::get('lop-hoc/{id}', 'AttendanceController@index')->name('attendance.index');
    Route::get('diem-danh/{id}', 'AttendanceController@create')->name('attendance.create');
    Route::get('danh-sach-lop-dang-day', 'ClassController@getClassByTeacher')->name('classes.getClassByTeacher');
    Route::post('diem-danh/store', 'AttendanceController@store')->name('attendance.store'); 
});
