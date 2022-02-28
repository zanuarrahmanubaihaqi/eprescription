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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/underconstruction', function () {
    return view('underconstruction');
})->name('underconstruction');

Route::get('/admin/maintenance/convertToCsv/{table_name}', 'ConvertToCsvController@convertToCsv')->name('convertToCsv');
Route::get('/admin/maintenance/getDataToTxt/{table_name}', 'ConvertToCsvController@getDataToTxt')->name('getDataToTxt');
Route::get('/admin/maintenance/getFileContentAndMakeTable/{table_name}', 'ConvertToCsvController@getFileContentAndMakeTable')->name('getFileContentAndMakeTable');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@welcome')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/get_notification_data', 'HomeController@get_notification_data')->name('get_notification_data');
Route::get('/get_notification_detail/{user_id}', 'HomeController@get_notification_detail')->name('get_notification_detail');
Route::get('/notification_seen/{user_id}', 'HomeController@notification_seen')->name('notification_seen');


Route::get('/about', function () {
    return view('about');
})->name('about');

// Route::group(['prefix'=>'master','as'=>'master.'], function(){
//     Route::get('/daily', ['as' => 'daily', 'uses' => 'MasterDataController@daily']);
//     Route::get('/monthly', ['as' => 'monthly', 'uses' => 'MasterDataController@monthly']);
// });

Route::group(['prefix'=>'user_management','as'=>'user_management.'], function(){
  Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
  Route::post('/store', ['as' => 'store', 'uses' => 'UserController@store']);
  Route::post('/store_struktur', ['as' => 'store_struktur', 'uses' => 'UserController@store_struktur']);
  Route::get('/update/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
  Route::get('/struktur', ['as' => 'struktur', 'uses' => 'UserController@struktur']);
  Route::get('/delete{id}', ['as' => 'delete', 'uses' => 'UserController@delete']);
});

Route::group([
    'prefix' => 'pendaftaran', 
    'as' => 'pendaftaran.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'PendaftaranController@index'
            ]);
            Route::post('/tambah', [
                'as' => 'tambah',
                'uses' => 'PendaftaranController@tambah'
            ]);
            Route::post('/edit', [
                'as' => 'edit',
                'uses' => 'PendaftaranController@edit'
            ]);         
});

Route::group([
    'prefix' => 'kunjungan', 
    'as' => 'kunjungan.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'KunjunganController@index'
            ]);
            Route::post('/tambah', [
                'as' => 'tambah',
                'uses' => 'KunjunganController@tambah'
            ]);         
});

Route::group([
    'prefix' => 'obat', 
    'as' => 'obat.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'ObatController@index'
            ]);
            Route::post('/tambah', [
                'as' => 'tambah',
                'uses' => 'ObatController@tambah'
            ]);
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'ObatController@update'
            ]);
            Route::delete('/delete', [
                'as' => 'delete',
                'uses' => 'ObatController@delete'
            ]);
        }
);

Route::group([
    'prefix' => 'signa', 
    'as' => 'signa.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'SignaController@index'
            ]);
            Route::post('/tambah', [
                'as' => 'tambah',
                'uses' => 'SignaController@tambah'
            ]);
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'SignaController@update'
            ]);
            Route::delete('/delete', [
                'as' => 'delete',
                'uses' => 'SignaController@delete'
            ]);
        }
);

Route::group([
    'prefix' => 'resep', 
    'as' => 'resep.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'ResepController@index'
            ]);
            Route::post('/tambah', [
                'as' => 'tambah',
                'uses' => 'ResepController@tambah'
            ]);
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'ResepController@update'
            ]);
            Route::delete('/delete', [
                'as' => 'delete',
                'uses' => 'ResepController@delete'
            ]);
            Route::get('/get-obat', [
                'as' => 'get-obat'
            ]);
        }
);

Route::get('clear-app', function () {
    try {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return '<pre>App Cleared !</pre>';
    } catch (Exception $e) {
        report($e);
        return '<pre>Failed to clear app.</pre>';
    }
});

Route::get('phpinfo', function (){
    return view('phpinfo');
});

Route::get('emergency-logout', function (){
    Auth::logout();
    return view('welcome');
});