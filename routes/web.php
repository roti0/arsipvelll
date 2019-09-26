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

use App\Jobs;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/fired', 'AdminDashboardController@showfired')->name('admin.fired');
Route::get('/home/fired ','AdminDashboardController@fire')->name('admin.fire');

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

Route::get('/payment','PaymentSalaryController@index')->name('admin.payment');
Route::patch('/payment/{payment}','PaymentSalaryController@update')->name('admin.updatepayment');
Route::post('/payment/create','PaymentSalaryController@create')->name('admin.createpayment');

Route::get('/ajax/{divisi_id}','AdminDashboardController@ajax');
