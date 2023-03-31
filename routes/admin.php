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
        Route::get('/','PatientManagmentController@index')->name('admin.patientManagment');
        Route::get('/search','PatientManagmentController@search')->name('admin.patient.search');
        Route::get('create','PatientManagmentController@create')->name('admin.patientManagment.create');
        Route::post('store','PatientManagmentController@store')->name('admin.patientManagment.store');
        Route::get('/history/{id}','PatientManagmentController@history')->name('admin.patientManagment.history');

        Route::get('/searchHistory/{patient_id}','PatientManagmentController@searchHistory')->name('admin.patientHistory.search');

        Route::get('/filter','PatientManagmentController@filter')->name('admin.patientManagment.filter');
        Route::get('/showResults/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@showResults')->name('admin.patientManagment.result');

        Route::get('/editResult/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@editResult')->name('admin.patient.editResult');
        Route::post('/updateResult/{analysis_required_id}/{patient_id}','PatientManagmentController@updateResult')->name('admin.patient.updateResult');

        Route::get('/addAnalysis','PatientManagmentController@addAnalysis')->name('admin.patientManagment.addAnalysis');
        Route::get('/watingAnalysis','PatientManagmentController@analysisWating')->name('admin.patientManagment.AnalysisWating');
        Route::get('/searchAnalysis','PatientManagmentController@searchAnalysisWaitingResult')->name('admin.patient.searchAnalysisWaitingResult');
        Route::get('/showRequiredAnalysis/{analysis_id}','PatientManagmentController@showRequiredAnalysis')->name('admin.patient.showRequiredAnalysis');
        Route::get('/enterResult/{analysis_id}/{patient_id}/{analysis_required_id}','PatientManagmentController@enterResult')->name('admin.patient.enterResult');
        Route::post('/saveResult/{analysis_required_id}/{analysis_id}','PatientManagmentController@saveResult')->name('admin.patient.saveResult');


        Route::get('edit/{id}','PatientManagmentController@edit')->name('admin.patientManagment.edit');
        Route::post('update/{id}','PatientManagmentController@update')->name('admin.patientManagment.update');//or put

        Route::post('/confirmDiscount','PatientManagmentController@confirmDiscount')->name('admin.patientManagment.confirmDiscount');
        Route::get('/showConfirmDiscount/{id}','PatientManagmentController@showConfirmDiscount')->name('admin.patientManagment.showConfirmDiscount');
        Route::post('/confirmPayment','PatientManagmentController@confirmPayment')->name('admin.patientManagment.confirmPayment');
        Route::any('/decline/{id}/{patient_name}','PatientManagmentController@declineDiscount')->name('admin.patientManagment.declineDiscount');

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
        Route::get('/','AnalysisController@index')->name('admin.showAnalysis');
        Route::get('showForm/{id}','AnalysisController@viewForm')->name('admin.showAnalysis.form');
        Route::post('updateForm/{id}','AnalysisController@analysisUpdateForm')->name('admin.showAnalysis.updateForm');
        Route::any('deleteInput/{analysis_id}/{input_id}','AnalysisController@deleteInput')->name('admin.showAnalysis.deleteInput');
        Route::any('deleteInput/{analysis_id}/{input_id}/{option_id}','AnalysisController@deleteOption')->name('admin.showAnalysis.deleteOption');
        Route::any('deleteInputName/{analysis_id}/{input_id}','AnalysisController@deleteInputName')->name('admin.showAnalysis.deleteInputName');
       Route::get('addInput/{id}','AnalysisController@AddNewInputs')->name('admin.analysis.addInputs');
       Route::post('storeInput/{id}','AnalysisController@storeNewInputs')->name('admin.analysis.storeInputs');


        Route::get('/search','AnalysisController@search')->name('admin.search');
        Route::get('/fiter', 'AnalysisController@filter')->name('admin.filter');
       Route::get('create','AnalysisController@createForm')->name('admin.analysis.create');
       Route::post('store','AnalysisController@storeForm')->name('admin.analysis.store');
    });
    ########################end analysis managment###########################

    #######################financial managment##########################
    Route::group(['prefix'=>'financialDetails', 'namespace'=>'Admin'],function(){
        Route::get('/','FinancialController@index')->name('admin.laboratryAnalysisPrice');
      Route::get('/search','FinancialController@search')->name('admin.laboratoryDetails.search');
       Route::get('edit/{id}','FinancialController@edit')->name('admin.laboratoryDetails.edit');
       Route::post('update/{id}','FinancialController@update')->name('admin.laboratoryDetails.update');//or put
    });


    #######################end financial managment##########################


    ####################### discount ##########################
    Route::group(['prefix'=>'discount',  'namespace'=>'Admin'],function(){
        Route::get('/','DiscountController@index')->name('admin.discount');
        Route::get('create','DiscountController@createDiscount')->name('admin.discount.create');
        Route::post('store','DiscountController@storeDiscount')->name('admin.discount.store');
        Route::get('/search','DiscountController@search')->name('admin.discount.search');
        Route::get('edit/{id}','DiscountController@edit')->name('admin.discount.edit');
        Route::post('update/{id}','DiscountController@update')->name('admin.discount.update');
    });


    #######################end discount ##########################

    ####################### doctor ##########################
    Route::group(['prefix'=>'doctor',  'namespace'=>'Admin'],function(){
       Route::get('/','DoctorController@index')->name('admin.doctor.managment');
       Route::get('create','DoctorController@addDoctor')->name('admin.doctor.create');
       Route::post('store','DoctorController@storeDoctor')->name('admin.doctor.store');
       Route::get('/search','DoctorController@search')->name('admin.doctor.search');
       Route::get('edit/{id}','DoctorController@edit')->name('admin.doctor.edit');
       Route::post('update/{id}','DoctorController@update')->name('admin.doctor.update');
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
    Route::get('/','ActionController@index')->name('admin.action.index');
    Route::get('/userActions','ActionController@getUserAction')->name('admin.action.getUserActions');
    Route::get('/logging','ActionController@getLogging')->name('admin.action.logging');
    Route::get('/showlogging','ActionController@showDetialsLogging')->name('admin.action.showDetialsLogging');

});

});



// Route::get('/home', 'HomeController@index')->name('home');



