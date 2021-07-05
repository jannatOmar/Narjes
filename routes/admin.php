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
Route::group(['prefix'=>'admin','middleware'=>['auth:admin','prevent-back-history']],function(){
    Route::get('/','Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/logout','Admin\DashboardController@logout')->name('admin.logout');
    Route::get('/aboutus', 'Admin\DashboardController@aboutus')->name('admin.aboutus');

    ####################patientmanagment##############
    Route::group(['prefix'=>'patientManagment', 'namespace'=>'Admin'],function(){
        Route::get('/','patientManagmentController@index')->name('admin.patientManagment');
        Route::get('/search','patientManagmentController@search')->name('admin.patient.search');
        Route::get('create','patientManagmentController@create')->name('admin.patientManagment.create');
        Route::post('store','patientManagmentController@store')->name('admin.patientManagment.store');
        Route::get('/history/{id}','patientManagmentController@history')->name('admin.patientManagment.history');

        Route::get('/searchHistory/{patient_id}','patientManagmentController@searchHistory')->name('admin.patientHistory.search');

        Route::get('/filter','patientManagmentController@filter')->name('admin.patientManagment.filter');
        Route::get('/showResults/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@showResults')->name('admin.patientManagment.result');

        Route::get('/editResult/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@editResult')->name('admin.patient.editResult');
        Route::post('/updateResult/{analysis_required_id}/{patient_id}','patientManagmentController@updateResult')->name('admin.patient.updateResult');

        Route::get('/addAnalysis','patientManagmentController@addAnalysis')->name('admin.patientManagment.addAnalysis');
        Route::get('/watingAnalysis','patientManagmentController@analysisWating')->name('admin.patientManagment.AnalysisWating');
        Route::get('/searchAnalysis','patientManagmentController@searchAnalysisWaitingResult')->name('admin.patient.searchAnalysisWaitingResult');
        Route::get('/showRequiredAnalysis/{analysis_id}','patientManagmentController@showRequiredAnalysis')->name('admin.patient.showRequiredAnalysis');
        Route::get('/enterResult/{analysis_id}/{patient_id}/{analysis_required_id}','patientManagmentController@enterResult')->name('admin.patient.enterResult');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','patientManagmentController@saveResult')->name('admin.patient.saveResult');


        Route::get('edit/{id}','patientManagmentController@edit')->name('admin.patientManagment.edit');
        Route::post('update/{id}','patientManagmentController@update')->name('admin.patientManagment.update');//or put

        Route::post('/confirmDiscount','patientManagmentController@confirmDiscount')->name('admin.patientManagment.confirmDiscount');
        Route::get('/showConfirmDiscount/{id}','patientManagmentController@showConfirmDiscount')->name('admin.patientManagment.showConfirmDiscount');
        Route::post('/confirmPayment','patientManagmentController@confirmPayment')->name('admin.patientManagment.confirmPayment');
        Route::any('/decline/{id}/{patient_name}','patientManagmentController@declineDiscount')->name('admin.patientManagment.declineDiscount');

    });
    ########################end patientmanagment###########################

    ####################user##############
    Route::group(['prefix'=>'userManagment', 'namespace'=>'Admin'],function(){
        Route::get('/','userController@index')->name('admin.myProfile');
        Route::get('create','userController@create')->name('admin.userManagment.create');
        Route::get('/search','userController@search')->name('admin.user.search');
        Route::get('/filter', 'userController@filter')->name('admin.user.filter');
        Route::post('store','userController@store')->name('admin.userManagment.store');
        Route::get('/userManagment','userController@userManagment')->name('admin.userManagment');
        Route::get('edit/{id}','userController@edit')->name('admin.userManagment.edit');
        Route::post('update/{id}','userController@update')->name('admin.userManagment.update');//or put
    });
    ########################end user###########################


    ####################analysis managment##############
    Route::group(['prefix'=>'analysis',  'namespace'=>'Admin'],function(){
        Route::get('/','analysisController@index')->name('admin.showAnalysis');
        Route::get('showForm/{id}','analysisController@viewForm')->name('admin.showAnalysis.form');
        Route::post('updateForm/{id}','analysisController@analysisUpdateForm')->name('admin.showAnalysis.updateForm');
        Route::any('deleteInput/{analysis_id}/{input_id}','analysisController@deleteInput')->name('admin.showAnalysis.deleteInput');
        Route::any('deleteInput/{analysis_id}/{input_id}/{option_id}','analysisController@deleteOption')->name('admin.showAnalysis.deleteOption');
        Route::any('deleteInputName/{analysis_id}/{input_id}','analysisController@deleteInputName')->name('admin.showAnalysis.deleteInputName');
       Route::get('addInput/{id}','analysisController@AddNewInputs')->name('admin.analysis.addInputs');
       Route::post('storeInput/{id}','analysisController@storeNewInputs')->name('admin.analysis.storeInputs');


        Route::get('/search','analysisController@search')->name('admin.search');
        Route::get('/fiter', 'analysisController@filter')->name('admin.filter');
       Route::get('create','analysisController@createForm')->name('admin.analysis.create');
       Route::post('store','analysisController@storeForm')->name('admin.analysis.store');
    });
    ########################end analysis managment###########################

    #######################financial managment##########################
    Route::group(['prefix'=>'financialDetails', 'namespace'=>'Admin'],function(){
        Route::get('/','financialController@index')->name('admin.laboratryAnalysisPrice');
      Route::get('/search','financialController@search')->name('admin.laboratoryDetails.search');
       Route::get('edit/{id}','financialController@edit')->name('admin.laboratoryDetails.edit');
       Route::post('update/{id}','financialController@update')->name('admin.laboratoryDetails.update');//or put
    });


    #######################end financial managment##########################


    ####################### discount ##########################
    Route::group(['prefix'=>'discount',  'namespace'=>'Admin'],function(){
        Route::get('/','discountController@index')->name('admin.discount');
        Route::get('create','discountController@createDiscount')->name('admin.discount.create');
        Route::post('store','discountController@storeDiscount')->name('admin.discount.store');
        Route::get('/search','discountController@search')->name('admin.discount.search');
        Route::get('edit/{id}','discountController@edit')->name('admin.discount.edit');
        Route::post('update/{id}','discountController@update')->name('admin.discount.update');
    });


    #######################end discount ##########################

    ####################### doctor ##########################
    Route::group(['prefix'=>'doctor',  'namespace'=>'Admin'],function(){
       Route::get('/','doctorController@index')->name('admin.doctor.managment');
       Route::get('create','doctorController@addDoctor')->name('admin.doctor.create');
       Route::post('store','doctorController@storeDoctor')->name('admin.doctor.store');
       Route::get('/search','doctorController@search')->name('admin.doctor.search');
       Route::get('edit/{id}','doctorController@edit')->name('admin.doctor.edit');
       Route::post('update/{id}','doctorController@update')->name('admin.doctor.update');
    });


    #######################end doctor ##########################


 ####################### reports ##########################
 Route::group(['prefix'=>'report',  'namespace'=>'Admin'],function(){
    Route::get('/','ReportsController@Patient')->name('admin.report.patient');
     Route::get('/analysisReport','ReportsController@Analysis')->name('admin.report.analysis');
    Route::get('/showReportPatient','ReportsController@showPatientReport')->name('admin.report.showPatientReport');
     Route::get('/showReport','ReportsController@showAnalysisReport')->name('admin.report.showAnalysis');
     Route::get('/showReportDiscount','ReportsController@Discount')->name('admin.report.showDiscount');
     Route::get('/showDiscount','ReportsController@ShowDiscount')->name('admin.report.ShowDiscount');

 });


 #######################end Reports ##########################

   Route::group(['prefix'=>'action',  'namespace'=>'Admin'],function(){
    Route::get('/','actionController@index')->name('admin.action.index');
    Route::get('/userActions','actionController@getUserAction')->name('admin.action.getUserActions');
    Route::get('/logging','actionController@getLogging')->name('admin.action.logging');
    Route::get('/showlogging','actionController@showDetialsLogging')->name('admin.action.showDetialsLogging');

});

});



// Route::get('/home', 'HomeController@index')->name('home');



