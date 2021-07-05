<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();


Route::group(['prefix'=>'user','namespace'=>'login'],function(){
Route::get('login', 'LoginController@getLogin')->name('get.user.login');
Route::post('login', 'LoginController@Login')->name('user.login');

});

Route::get('/home', 'HomeController@index')->name('home');


