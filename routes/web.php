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

    Route::match(['get', 'post'], '/leads', 'LeadController@list')->name('lead.list');
    Route::get('/leads/{id}', 'LeadController@index')->name('lead.index')->where('id', '[0-9]+');;
    Route::delete('/leads/{id}', 'LeadController@destroy')->name('lead.destroy')->where('id', '[0-9]+');;

    Route::get('/messages', 'MessageController@index')->name('message.index');
    Route::get('/messages/create', 'MessageController@create')->name('message.create');
    Route::post('/messages/store', 'MessageController@store')->name('message.store');
    Route::delete('/messages/{id}', 'MessageController@destroy')->name('message.destroy')->where('id', '[0-9]+');;

    Route::get('/answers', 'AnswerController@index')->name('answer.index');
    Route::get('/answers/create', 'AnswerController@create')->name('answer.create');
    Route::post('/answers/store', 'AnswerController@store')->name('answer.store');
    Route::delete('/answers/{id}', 'AnswerController@destroy')->name('answer.destroy')->where('id', '[0-9]+');;

    Route::get('/notifications', 'NotificationController@index')->name('notification.index');
    Route::match(['post', 'get'], '/notifications/create', 'NotificationController@create')->name('notification.create');
    Route::post('/notifications/store', 'NotificationController@store')->name('notification.store');
});
