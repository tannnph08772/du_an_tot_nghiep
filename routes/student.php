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
    'middleware' => 'checkAuth',
], function(){
    Route::group([
        'middleware' => 'checkStudent',
    ], function(){
        Route::get('/bai-tap', 'HomeWorkController@show')->name('homework.show'); 
        Route::get('/chi-tiet-bai-tap/{id}', 'HomeWorkController@chiTietBT')->name('chiTietBT');
        Route::post('/nop-bai/{id}', 'HomeWorkController@nopBai')->name('nopBai');
        Route::get('sinh-vien/lich-hoc','AttendanceController@showCalendarStu')->name('student.showCalendarStu');
        Route::get('sinh-vien/diem-danh','AttendanceController@showAttendance')->name('student.showAttendance');
        Route::get('sinh-vien/don-chuyen-lop','IndexController@showForm')->name('student.showForm');
        Route::post('sinh-vien/don-chuyen-lop/store','IndexController@storeForm')->name('student.storeForm');
        Route::get('/gop-y-cua-hoc-vien', 'FeedbackController@showfeedback')->name('feedback.showfeedback');
        Route::post('/','FeedbackController@store')->name('feedback.store');
        Route::get('/cam-on', 'FeedbackController@thanks')->name('feedback.thanks');
        Route::get('/thong-tin-ca-nhan','UserController@viewProfile')->name('user.viewProfile');
        Route::get('/doi-mat-khau','UserController@resetPW')->name('user.resetPW');
        Route::post('luu-mat-khau','UserController@ResetPassword')->name('user-savepw');
    });
});
Route::get('/download/{file}', 'HomeWorkController@download')->name('download');
Route::post('/store', 'AuthController@store')->name('auth.store');