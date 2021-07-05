<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


if (!defined('PAGINATION_COUNT')) {
   define('PAGINATION_COUNT',5);
}
Auth::routes();
Route::group(['prefix'=>'employee','middleware'=>['auth:employee','prevent-back-history']],function(){
    Route::get('/','employee\DashboardController@index')->name('employee.dashboard');
    Route::get('/logout','employee\DashboardController@logout')->name('employee.logout');
    Route::get('/aboutus', 'employee\DashboardController@aboutus')->name('employee.aboutus');
    Route::get('/readNotification/{data}/{created_at}/{sender}', 'employee\DashboardController@readNotification')->name('employee.readNotification');

    ####################patientmanagment##############
    Route::group(['prefix'=>'patientManagment', 'namespace'=>'Employee'],function(){
        Route::get('/','patientManagmentController@index')->name('employee.patientManagment');
        Route::get('/search','patientManagmentController@search')->name('employee.patient.search');

        Route::get('/history/{id}','patientManagmentController@history')->name('employee.patientManagment.history');
        Route::get('/searchHistory/{patient_id}','patientManagmentController@searchHistory')->name('employee.patientHistory.search');

        Route::get('/showResults/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@showResults')->name('employee.patientManagment.result');

        Route::get('/watingAnalysis','patientManagmentController@analysisWating')->name('employee.patientManagment.AnalysisWating');
        Route::get('/searchAnalysis','patientManagmentController@searchAnalysisWaitingResult')->name('employee.patient.searchAnalysisWaitingResult');
        Route::get('/showRequiredAnalysis/{analysis_id}','patientManagmentController@showRequiredAnalysis')->name('employee.patient.showRequiredAnalysis');
        Route::get('/enterResult/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@enterResult')->name('employee.patient.enterResult');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','patientManagmentController@saveResult')->name('employee.patient.saveResult');


    });
    ########################end patientmanagment###########################
    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Employee'],function(){
        Route::get('/','userController@index')->name('employee.myProfile');
    });
    ########################end user###########################


    ####################analysis managment##############
    Route::group(['prefix'=>'analysis',  'namespace'=>'Employee'],function(){
        Route::get('/','analysisController@index')->name('employee.showAnalysis');
        Route::get('showForm/{id}','analysisController@viewForm')->name('employee.showAnalysis.form');
        Route::get('/search','analysisController@search')->name('employee.search');
        Route::get('/fiter', 'analysisController@filter')->name('employee.filter');
       
    });
    ########################end analysis managment###########################

   

});




