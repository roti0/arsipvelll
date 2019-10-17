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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['user','auth']], function () {
    Route::get('/home/myattendance','UserDashboardController@index')->name('user.myattendance');
    Route::get('/home/mypayment','UserDashboardController@payment')->name('user.mypayment');
    Route::patch('/home/{attendance}','AttendanceController@userattendance')->name('user.attendance');
    Route::patch('/home/out/{out}','AttendanceController@outattendance')->name('user.outattendance');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin','auth']], function () {
    Route::get('/home/fired', 'AdminDashboardController@showfired')->name('admin.fired');
    Route::patch('/home/{data}','AdminDashboardController@fire')->name('admin.fire');

    Route::get('/home/search','AdminDashboardController@search')->name('admin.searchuser');
    Route::get('/home/fired/search','AdminDashboardController@searchfire')->name('admin.searchuserfire');

    Route::get('/division','DivisionController@index')->name('admin.divisi');
    Route::patch('/division/{divisi}','DivisionController@update')->name('admin.updatedivisi');
    Route::post('/division/create','DivisionController@create')->name('admin.createdivisi');
    
    Route::get('/jobs','JobsController@index')->name('admin.jobs');
    Route::patch('/jobs/{jobs}','JobsController@update')->name('admin.updatejobs');
    Route::post('/jobs/create','JobsController@create')->name('admin.createjobs');
    
    Route::get('/home/{id}/editemployee','AdminDashboardController@edit')->name('admin.edit');
    Route::post('/home/{data}/editemployee','AdminDashboardController@update')->name('admin.update');
    Route::get('/home/addemployee','AdminDashboardController@addemployee')->name('admin.addemployee');

    Route::get('/attendance','AttendanceController@index')->name('admin.attendance');
    Route::patch('/attendance/{attendance}','AttendanceController@update')->name('admin.updateattendance');
    Route::post('/attendance/create','AttendanceController@create')->name('admin.createattendance');
    Route::get('/attendance/search','AttendanceController@search')->name('admin.searchattendance');
    
    Route::get('/payment','PaymentSalaryController@index')->name('admin.payment');
    Route::patch('/payment/{payment}','PaymentSalaryController@update')->name('admin.updatepayment');
    Route::post('/payment/create','PaymentSalaryController@create')->name('admin.createpayment');

    Route::get('/ajax/{divisi_id}','AdminDashboardController@ajax');
        
});
