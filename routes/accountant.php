<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

if (!defined('PAGINATION_COUNT')) {
   define('PAGINATION_COUNT',5);
}
Auth::routes();
Route::group(['prefix'=>'accountant','middleware'=>['auth:accountant','prevent-back-history']],function(){
    Route::get('/','Accountant\DashboardController@index')->name('accountant.dashboard');
    Route::get('/logout','Accountant\DashboardController@logout')->name('accountant.logout');
    Route::get('/aboutus', 'Accountant\DashboardController@aboutus')->name('accountant.aboutus');
    Route::get('/readNotification/{notify_id}', 'Accountant\DashboardController@readNotification')->name('accountant.readNotification');

    ####################patientmanagment##############
    Route::group(['prefix'=>'patientManagment', 'namespace'=>'Accountant'],function(){
        Route::get('/','patientManagmentController@index')->name('accountant.patientManagment');
        Route::get('/search','patientManagmentController@search')->name('accountant.patient.search');
        Route::get('create','patientManagmentController@create')->name('accountant.patientManagment.create');
        Route::post('store','patientManagmentController@store')->name('accountant.patientManagment.store');


        Route::get('/filter','patientManagmentController@filter')->name('accountant.patientManagment.filter');

        Route::get('/addAnalysis','patientManagmentController@addAnalysis')->name('accountant.patientManagment.addAnalysis');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','patientManagmentController@saveResult')->name('accountant.patient.saveResult');


        Route::get('edit/{id}','patientManagmentController@edit')->name('accountant.patientManagment.edit');
        Route::post('update/{id}','patientManagmentController@update')->name('accountant.patientManagment.update');//or put
        Route::post('/confirmDiscount','patientManagmentController@confirmDiscount')->name('accountant.patientManagment.confirmDiscount');
        Route::post('/confirmPayment','patientManagmentController@confirmPayment')->name('accountant.patientManagment.confirmPayment');

    });
    ########################end patientmanagment###########################

    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Accountant'],function(){
        Route::get('/','userController@index')->name('accountant.myProfile');
    });
    ########################end user###########################

});


