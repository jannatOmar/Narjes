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
Route::group(['prefix'=>'manager','middleware'=>['auth:manager','prevent-back-history']],function(){
    Route::get('/','Manager\DashboardController@index')->name('manager.dashboard');
    Route::get('/logout','Manager\DashboardController@logout')->name('manager.logout');
    Route::get('/aboutus', 'Manager\DashboardController@aboutus')->name('manager.aboutus');
    Route::get('/readNotification/{data}/{created_at}/{sender}', 'Manager\DashboardController@readNotification')->name('Manager.readNotification');


    ####################patientmanagment##############
    Route::group(['prefix'=>'patientManagment', 'namespace'=>'Manager'],function(){
        Route::get('/','PatientManagmentController@index')->name('manager.patientManagment');
        Route::get('/search','PatientManagmentController@search')->name('manager.patient.search');
        Route::get('create','PatientManagmentController@create')->name('manager.patientManagment.create');
        Route::post('store','PatientManagmentController@store')->name('manager.patientManagment.store');
        Route::get('/history/{id}','PatientManagmentController@history')->name('manager.patientManagment.history');

        Route::get('/searchHistory/{patient_id}','PatientManagmentController@searchHistory')->name('manager.patientHistory.search');

        Route::get('/filter','PatientManagmentController@filter')->name('manager.patientManagment.filter');
        Route::get('/showResults/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@showResults')->name('manager.patientManagment.result');

        Route::get('/editResult/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@editResult')->name('manager.patient.editResult');
        Route::post('/updateResult/{analysis_required_id}/{patient_id}','PatientManagmentController@updateResult')->name('manager.patient.updateResult');

        Route::get('/addAnalysis','PatientManagmentController@addAnalysis')->name('manager.patientManagment.addAnalysis');
        Route::get('/watingAnalysis','PatientManagmentController@analysisWating')->name('manager.patientManagment.AnalysisWating');
        Route::get('/searchAnalysis','PatientManagmentController@searchAnalysisWaitingResult')->name('manager.patient.searchAnalysisWaitingResult');
        Route::get('/showRequiredAnalysis/{analysis_id}','PatientManagmentController@showRequiredAnalysis')->name('manager.patient.showRequiredAnalysis');
        Route::get('/enterResult/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@enterResult')->name('manager.patient.enterResult');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','PatientManagmentController@saveResult')->name('manager.patient.saveResult');


        Route::get('edit/{id}','PatientManagmentController@edit')->name('manager.patientManagment.edit');
        Route::post('update/{id}','PatientManagmentController@update')->name('manager.patientManagment.update');//or put
        Route::post('/confirmDiscount','PatientManagmentController@confirmDiscount')->name('manager.patientManagment.confirmDiscount');
        Route::post('/confirmPayment','PatientManagmentController@confirmPayment')->name('manager.patientManagment.confirmPayment');

    });
    ########################end patientmanagment###########################

    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Manager'],function(){
        Route::get('/','userController@index')->name('manager.myProfile');
    });
    ########################end user###########################


    ####################analysis managment##############
    Route::group(['prefix'=>'analysis',  'namespace'=>'Manager'],function(){
        Route::get('/','AnalysisController@index')->name('manager.showAnalysis');
        Route::get('showForm/{id}','AnalysisController@viewForm')->name('manager.showAnalysis.form');
        Route::post('updateForm/{id}','AnalysisController@analysisUpdateForm')->name('manager.showAnalysis.updateForm');
        Route::any('deleteInput/{analysis_id}/{input_id}','AnalysisController@deleteInput')->name('manager.showAnalysis.deleteInput');
        Route::any('deleteInput/{analysis_id}/{input_id}/{option_id}','AnalysisController@deleteOption')->name('manager.showAnalysis.deleteOption');
        Route::any('deleteInputName/{analysis_id}/{input_id}','AnalysisController@deleteInputName')->name('manager.showAnalysis.deleteInputName');
       Route::get('addInput/{id}','AnalysisController@AddNewInputs')->name('manager.analysis.addInputs');
       Route::post('storeInput/{id}','AnalysisController@storeNewInputs')->name('manager.analysis.storeInputs');


        Route::get('/search','AnalysisController@search')->name('manager.search');
        Route::get('/fiter', 'AnalysisController@filter')->name('manager.filter');
       Route::get('create','AnalysisController@createForm')->name('manager.analysis.create');
       Route::post('store','AnalysisController@storeForm')->name('manager.analysis.store');
    });
    ########################end analysis managment###########################

    #######################financial managment##########################
    Route::group(['prefix'=>'financialDetails', 'namespace'=>'Manager'],function(){
        Route::get('/','FinancialController@index')->name('manager.laboratryAnalysisPrice');
      Route::get('/search','FinancialController@search')->name('manager.laboratoryDetails.search');
       Route::get('edit/{id}','FinancialController@edit')->name('manager.laboratoryDetails.edit');
       Route::post('update/{id}','FinancialController@update')->name('manager.laboratoryDetails.update');//or put
    });


    #######################end financial managment##########################

    ####################### doctor ##########################
    Route::group(['prefix'=>'doctor',  'namespace'=>'Manager'],function(){
       Route::get('/','DoctorController@index')->name('manager.doctor.managment');
       Route::get('create','DoctorController@addDoctor')->name('manager.doctor.create');
       Route::post('store','DoctorController@storeDoctor')->name('manager.doctor.store');
       Route::get('/search','DoctorController@search')->name('manager.doctor.search');
       Route::get('edit/{id}','DoctorController@edit')->name('manager.doctor.edit');
       Route::post('update/{id}','DoctorController@update')->name('manager.doctor.update');
    });


    #######################end doctor ##########################

});





