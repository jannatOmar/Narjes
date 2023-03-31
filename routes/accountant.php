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
        Route::get('/','PatientManagmentController@index')->name('accountant.patientManagment');
        Route::get('/search','PatientManagmentController@search')->name('accountant.patient.search');
        Route::get('create','PatientManagmentController@create')->name('accountant.patientManagment.create');
        Route::post('store','PatientManagmentController@store')->name('accountant.patientManagment.store');


        Route::get('/filter','PatientManagmentController@filter')->name('accountant.patientManagment.filter');

        Route::get('/addAnalysis','PatientManagmentController@addAnalysis')->name('accountant.patientManagment.addAnalysis');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','PatientManagmentController@saveResult')->name('accountant.patient.saveResult');


        Route::get('edit/{id}','PatientManagmentController@edit')->name('accountant.patientManagment.edit');
        Route::post('update/{id}','PatientManagmentController@update')->name('accountant.patientManagment.update');//or put
        Route::post('/confirmDiscount','PatientManagmentController@confirmDiscount')->name('accountant.patientManagment.confirmDiscount');
        Route::post('/confirmPayment','PatientManagmentController@confirmPayment')->name('accountant.patientManagment.confirmPayment');

    });
    ########################end patientmanagment###########################

    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Accountant'],function(){
        Route::get('/','userController@index')->name('accountant.myProfile');
    });
    ########################end user###########################

});


