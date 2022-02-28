<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mirror Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "mirror" middleware group. Now create something great!
|
*/

Route::namespace('Mirror')->group(function () {
    Route::get('/mirror/login', 'MirrorHomeController@showLoginForm')->name('mirror-login');
    Route::post('/mirror/login', 'MirrorHomeController@postLogin')->name('mirror-login');
    Route::post('/mirror/logout', 'MirrorHomeController@logout')->name('mirror-logout');

    Route::group(['middleware' => 'auth:adminmirror'], function () {
        Route::group(['prefix' => 'mirror', 'as' => 'mirror-'], function () {
            Route::get('/profile', 'MirrorProfileController@index')->name('profile');
            Route::put('/profile', 'MirrorProfileController@update')->name('profile.update');

            Route::get('/home', 'MirrorHomeController@home')->name('home');
            Route::get('/get_notification_data', 'MirrorHomeController@get_notification_data')->name('get_notification_data');
            Route::get('/get_notification_detail/{user_id}', 'MirrorHomeController@get_notification_detail')->name('get_notification_detail');
            Route::get('/notification_seen/{user_id}', 'MirrorHomeController@notification_seen')->name('notification_seen');
        });

        Route::group(['prefix'=>'mirror-user_management','as'=>'mirror-user_management.'], function(){
            Route::get('/', ['as' => 'index', 'uses' => 'MirrorUserController@index']);
            Route::post('/store', ['as' => 'store', 'uses' => 'MirrorUserController@store']);
            Route::post('/store_struktur', ['as' => 'store_struktur', 'uses' => 'MirrorUserController@store_struktur']);
            Route::get('/update/{id}', ['as' => 'update', 'uses' => 'MirrorUserController@update']);
            Route::post('/update_struktur/{id}', ['as' => 'update_struktur', 'uses' => 'MirrorUserController@update_struktur']);
            Route::get('/struktur', ['as' => 'struktur', 'uses' => 'MirrorUserController@struktur']);
            Route::get('/delete/{id}', ['as' => 'delete', 'uses' => 'MirrorUserController@delete']);
        });

        Route::group(['prefix'=>'mirror-report','as'=>'mirror-report.'], function() {
            Route::group(['prefix'=>'daily','as'=>'daily.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'MirrorDailyReportController@index']);
                Route::get('/report/{id}', ['as' => 'report', 'uses' => 'MirrorDailyReportController@report']);
                Route::get('/detail/{id}', ['as' => 'detail', 'uses' => 'MirrorDailyReportController@detail']);
                Route::get('/approve1/{id}', ['as' => 'approve1', 'uses' => 'MirrorDailyReportController@approve1']);
                Route::get('/approve2/{id}', ['as' => 'approve2', 'uses' => 'MirrorDailyReportController@approve2']);
                Route::get('/approve3/{id}', ['as' => 'approve3', 'uses' => 'MirrorDailyReportController@approve3']);
                Route::get('/datadaily/{mesin?}', ['as' => 'datadaily', 'uses' => 'MirrorDailyReportController@datadaily']);
                Route::get('/newdatadaily/{mesin?}/{form?}/{bulan?}', ['as' => 'newdatadaily', 'uses' => 'MirrorDailyReportController@newdatadaily']);
            });

            Route::group(['prefix'=>'m1','as'=>'m1.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'MirrorM1ReportController@index']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'MirrorM1ReportController@report']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'MirrorM1ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'MirrorM1ReportController@approve']);
            });

            Route::group(['prefix'=>'m3','as'=>'m3.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'MirrorM3ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'MirrorM3ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'MirrorM3ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'MirrorM3ReportController@report']);
            });

            Route::group(['prefix'=>'m6','as'=>'m6.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'MirrorM6ReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'MirrorM6ReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'MirrorM6ReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'MirrorM6ReportController@report']);
            });
            
            Route::group(['prefix'=>'mVH','as'=>'mVH.'], function(){
                Route::get('/', ['as' => 'index', 'uses' => 'MirrorMVHReportController@index']);
                Route::get('/detail/{id_report}', ['as' => 'detail', 'uses' => 'MirrorMVHReportController@detail']);
                Route::get('/approve/{id_report}', ['as' => 'approve', 'uses' => 'MirrorMVHReportController@approve']);
                Route::get('/report/{id_report}', ['as' => 'report', 'uses' => 'MirrorMVHReportController@report']);
            });
        });
    });
});

Route::get('mirror-emergency-logout', function (){
    Auth::guard('adminmirror')->logout();
    return view('welcome');
});
