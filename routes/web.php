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

Route::get('/', 'App\Http\Controllers\SMSController@compose');
Route::post('send/sms', 'App\Http\Controllers\SMSController@sendSMS')->name('send.sms');
Route::get('sms/response', 'App\Http\Controllers\SMSController@smsResponse')->name('sms.response');
