<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mirror2w Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "mirror2w" middleware group. Now create something great!
|
*/

Route::namespace('Mirror2w')->group(function () {
    Route::get('/mirror2w/login', 'Mirror2wHomeController@showLoginForm')->name('mirror2w-login');
    Route::post('/mirror2w/login', 'Mirror2wHomeController@postLogin')->name('mirror2w-login');
    Route::post('/mirror2w/logout', 'Mirror2wHomeController@logout')->name('mirror2w-logout');

    Route::group(['middleware' => 'auth:adminmirror2w'], function () {
        Route::group(['prefix' => 'mirror2w', 'as' => 'mirror2w-'], function () {
            Route::get('/profile', 'Mirror2wProfileController@index')->name('profile');
            Route::put('/profile', 'Mirror2wProfileController@update')->name('profile.update');

            Route::get('/home', 'Mirror2wHomeController@home')->name('home');
            Route::get('/get_notification_data', 'Mirror2wHomeController@get_notification_data')->name('get_notification_data');
            Route::get('/get_notification_detail/{user_id}', 'Mirror2wHomeController@get_notification_detail')->name('get_notification_detail');
            Route::get('/notification_seen/{user_id}', 'Mirror2wHomeController@notification_seen')->name('notification_seen');
        });

        Route::group(['prefix'=>'mirror2w-user_management','as'=>'mirror2w-user_management.'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wUserController@index']);
            Route::post('/store', ['as' => 'store', 'uses' => 'Mirror2wUserController@store']);
            Route::post('/store_struktur', ['as' => 'store_struktur', 'uses' => 'Mirror2wUserController@store_struktur']);
            Route::get('/update/{id}', ['as' => 'update', 'uses' => 'Mirror2wUserController@update']);
            Route::post('/update_struktur/{id}', ['as' => 'update_struktur', 'uses' => 'Mirror2wUserController@update_struktur']);
            Route::get('/struktur', ['as' => 'struktur', 'uses' => 'Mirror2wUserController@struktur']);
            Route::get('/delete/{id}', ['as' => 'delete', 'uses' => 'Mirror2wUserController@delete']);
        });

        Route::group(['prefix'=>'mirror2w-report','as'=>'mirror2w-report.'], function() {
            Route::group(['prefix'=>'daily','as'=>'daily.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wDailyReportController@index']);
                Route::get('/report/{id}', ['as' => 'report', 'uses' => 'Mirror2wDailyReportController@report']);
                Route::get('/detail/{id}', ['as' => 'detail', 'uses' => 'Mirror2wDailyReportController@detail']);
                Route::get('/approve1/{id}', ['as' => 'approve1', 'uses' => 'Mirror2wDailyReportController@approve1']);
                Route::get('/approve2/{id}', ['as' => 'approve2', 'uses' => 'Mirror2wDailyReportController@approve2']);
                Route::get('/approve3/{id}', ['as' => 'approve3', 'uses' => 'Mirror2wDailyReportController@approve3']);
                Route::get('/datadaily/{mesin?}', ['as' => 'datadaily', 'uses' => 'Mirror2wDailyReportController@datadaily']);
                Route::get('/newdatadaily/{mesin?}/{bulan?}', ['as' => 'newdatadaily', 'uses' => 'Mirror2wDailyReportController@newdatadaily']);
            });

            Route::group(['prefix'=>'m1','as'=>'m1.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wM1ReportController@index']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Mirror2wM1ReportController@report']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Mirror2wM1ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Mirror2wM1ReportController@approve']);
            });

            Route::group(['prefix'=>'m3','as'=>'m3.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wM3ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Mirror2wM3ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Mirror2wM3ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Mirror2wM3ReportController@report']);
            });

            Route::group(['prefix'=>'m6','as'=>'m6.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wM6ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Mirror2wM6ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Mirror2wM6ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Mirror2wM6ReportController@report']);
            });
            
            Route::group(['prefix'=>'mVH','as'=>'mVH.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'Mirror2wMVHReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'Mirror2wMVHReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'Mirror2wMVHReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'Mirror2wMVHReportController@report']);
            });
        });
    });
});

Route::get('mirror2w-emergency-logout', function (){
    Auth::guard('adminmirror2w')->logout();
    return view('welcome');
});
