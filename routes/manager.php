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
        Route::get('/','patientManagmentController@index')->name('manager.patientManagment');
        Route::get('/search','patientManagmentController@search')->name('manager.patient.search');
        Route::get('create','patientManagmentController@create')->name('manager.patientManagment.create');
        Route::post('store','patientManagmentController@store')->name('manager.patientManagment.store');
        Route::get('/history/{id}','patientManagmentController@history')->name('manager.patientManagment.history');

        Route::get('/searchHistory/{patient_id}','patientManagmentController@searchHistory')->name('manager.patientHistory.search');

        Route::get('/filter','patientManagmentController@filter')->name('manager.patientManagment.filter');
        Route::get('/showResults/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@showResults')->name('manager.patientManagment.result');

        Route::get('/editResult/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@editResult')->name('manager.patient.editResult');
        Route::post('/updateResult/{analysis_required_id}/{patient_id}','patientManagmentController@updateResult')->name('manager.patient.updateResult');

        Route::get('/addAnalysis','patientManagmentController@addAnalysis')->name('manager.patientManagment.addAnalysis');
        Route::get('/watingAnalysis','patientManagmentController@analysisWating')->name('manager.patientManagment.AnalysisWating');
        Route::get('/searchAnalysis','patientManagmentController@searchAnalysisWaitingResult')->name('manager.patient.searchAnalysisWaitingResult');
        Route::get('/showRequiredAnalysis/{analysis_id}','patientManagmentController@showRequiredAnalysis')->name('manager.patient.showRequiredAnalysis');
        Route::get('/enterResult/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@enterResult')->name('manager.patient.enterResult');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','patientManagmentController@saveResult')->name('manager.patient.saveResult');


        Route::get('edit/{id}','patientManagmentController@edit')->name('manager.patientManagment.edit');
        Route::post('update/{id}','patientManagmentController@update')->name('manager.patientManagment.update');//or put
        Route::post('/confirmDiscount','patientManagmentController@confirmDiscount')->name('manager.patientManagment.confirmDiscount');
        Route::post('/confirmPayment','patientManagmentController@confirmPayment')->name('manager.patientManagment.confirmPayment');

    });
    ########################end patientmanagment###########################

    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Manager'],function(){
        Route::get('/','userController@index')->name('manager.myProfile');
    });
    ########################end user###########################


    ####################analysis managment##############
    Route::group(['prefix'=>'analysis',  'namespace'=>'Manager'],function(){
        Route::get('/','analysisController@index')->name('manager.showAnalysis');
        Route::get('showForm/{id}','analysisController@viewForm')->name('manager.showAnalysis.form');
        Route::post('updateForm/{id}','analysisController@analysisUpdateForm')->name('manager.showAnalysis.updateForm');
        Route::any('deleteInput/{analysis_id}/{input_id}','analysisController@deleteInput')->name('manager.showAnalysis.deleteInput');
        Route::any('deleteInput/{analysis_id}/{input_id}/{option_id}','analysisController@deleteOption')->name('manager.showAnalysis.deleteOption');
        Route::any('deleteInputName/{analysis_id}/{input_id}','analysisController@deleteInputName')->name('manager.showAnalysis.deleteInputName');
       Route::get('addInput/{id}','analysisController@AddNewInputs')->name('manager.analysis.addInputs');
       Route::post('storeInput/{id}','analysisController@storeNewInputs')->name('manager.analysis.storeInputs');


        Route::get('/search','analysisController@search')->name('manager.search');
        Route::get('/fiter', 'analysisController@filter')->name('manager.filter');
       Route::get('create','analysisController@createForm')->name('manager.analysis.create');
       Route::post('store','analysisController@storeForm')->name('manager.analysis.store');
    });
    ########################end analysis managment###########################

    #######################financial managment##########################
    Route::group(['prefix'=>'financialDetails', 'namespace'=>'Manager'],function(){
        Route::get('/','financialController@index')->name('manager.laboratryAnalysisPrice');
      Route::get('/search','financialController@search')->name('manager.laboratoryDetails.search');
       Route::get('edit/{id}','financialController@edit')->name('manager.laboratoryDetails.edit');
       Route::post('update/{id}','financialController@update')->name('manager.laboratoryDetails.update');//or put
    });


    #######################end financial managment##########################

    ####################### doctor ##########################
    Route::group(['prefix'=>'doctor',  'namespace'=>'Manager'],function(){
       Route::get('/','doctorController@index')->name('manager.doctor.managment');
       Route::get('create','doctorController@addDoctor')->name('manager.doctor.create');
       Route::post('store','doctorController@storeDoctor')->name('manager.doctor.store');
       Route::get('/search','doctorController@search')->name('manager.doctor.search');
       Route::get('edit/{id}','doctorController@edit')->name('manager.doctor.edit');
       Route::post('update/{id}','doctorController@update')->name('manager.doctor.update');
    });


    #######################end doctor ##########################

});





