<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function(){
    Route::get('/', 'DashboardController@index')->name('index');

    Route::get('/setting', 'SettingController@index')->name('setting.index');
    Route::post('/setting/store', 'SettingController@store')->name('setting.store');

    Route::get('/lead', 'LeadController@index')->name('lead.index');

    Route::get('/messages', 'MessageController@index')->name('messages.index');
    Route::get('/messages/create', 'MessageController@create')->name('messages.create');
    Route::post('/messages/store', 'MessageController@store')->name('messages.store');
    Route::delete('/messages/{id}', 'MessageController@destroy')->name('messages.destroy');
});
