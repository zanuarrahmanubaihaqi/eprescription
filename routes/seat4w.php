<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Seat4w Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "adminseat4w" middleware group. Now create something great!
|
*/

Route::namespace('Seat4w')->group(function () {
    Route::get('/seat4w/login', 'Seat4wHomeController@showLoginForm')->name('seat4w-login');
    Route::post('/seat4w/login', 'Seat4wHomeController@postLogin')->name('seat4w-login');
    Route::post('/seat4w/logout', 'Seat4wHomeController@logout')->name('seat4w-logout');

    Route::group(['middleware' => 'auth:adminseat4w'], function () {
        Route::group(['prefix' => 'seat4w', 'as' => 'seat4w-'], function () {
            Route::get('/profile', 'Seat4wProfileController@index')->name('profile');
            Route::put('/profile', 'Seat4wProfileController@update')->name('profile.update');

            Route::get('/home', 'Seat4wHomeController@home')->name('home');
            Route::get('/get_notification_data', 'Seat4wHomeController@get_notification_data')->name('get_notification_data');
            Route::get('/get_notification_detail/{user_id}', 'Seat4wHomeController@get_notification_detail')->name('get_notification_detail');
            Route::get('/notification_seen/{user_id}', 'Seat4wHomeController@notification_seen')->name('notification_seen');
        });

        Route::group(['prefix'=>'seat4w-user_management','as'=>'seat4w-user_management.'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'Seat4wUserController@index']);
            Route::post('/store', ['as' => 'store', 'uses' => 'Seat4wUserController@store']);
            Route::post('/store_struktur', ['as' => 'store_struktur', 'uses' => 'Seat4wUserController@store_struktur']);
            Route::get('/update/{id}', ['as' => 'update', 'uses' => 'Seat4wUserController@update']);
            Route::post('/update_struktur/{id}', ['as' => 'update_struktur', 'uses' => 'Seat4wUserController@update_struktur']);
            Route::get('/struktur', ['as' => 'struktur', 'uses' => 'Seat4wUserController@struktur']);
            Route::get('/delete/{id}', ['as' => 'delete', 'uses' => 'Seat4wUserController@delete']);
        });

        Route::group(['prefix'=>'seat4w-report','as'=>'seat4w-report.'], function() {
            Route::group(['prefix'=>'daily','as'=>'daily.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Seat4wDailyReportController@index']);
                Route::get('/report/{id}', ['as' => 'report', 'uses' => 'Seat4wDailyReportController@report']);
                Route::get('/detail/{id}', ['as' => 'detail', 'uses' => 'Seat4wDailyReportController@detail']);
                Route::get('/approve1/{id}', ['as' => 'approve1', 'uses' => 'Seat4wDailyReportController@approve1']);
                Route::get('/approve2/{id}', ['as' => 'approve2', 'uses' => 'Seat4wDailyReportController@approve2']);
                Route::get('/approve3/{id}', ['as' => 'approve3', 'uses' => 'Seat4wDailyReportController@approve3']);
                Route::get('/datadaily/{mesin?}', ['as' => 'datadaily', 'uses' => 'Seat4wDailyReportController@datadaily']);
                Route::get('/newdatadaily/{mesin?}/{bulan?}', ['as' => 'newdatadaily', 'uses' => 'Seat4wDailyReportController@newdatadaily']);
            });

            Route::group(['prefix'=>'m1','as'=>'m1.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Seat4wM1ReportController@index']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Seat4wM1ReportController@report']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Seat4wM1ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Seat4wM1ReportController@approve']);
            });

            Route::group(['prefix'=>'m3','as'=>'m3.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Seat4wM3ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Seat4wM3ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Seat4wM3ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Seat4wM3ReportController@report']);
            });

            Route::group(['prefix'=>'m6','as'=>'m6.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Seat4wM6ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Seat4wM6ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Seat4wM6ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Seat4wM6ReportController@report']);
            });
            
            Route::group(['prefix'=>'mVH','as'=>'mVH.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Seat4wMVHReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Seat4wMVHReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Seat4wMVHReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Seat4wMVHReportController@report']);
            });
        });
    });
});

Route::get('seat4w-emergency-logout', function (){
    Auth::guard('adminseat4w')->logout();
    return view('welcome');
});
