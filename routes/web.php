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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'admin'],function(){

// Route for dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Routes for company CRUD
Route::resource('company','CompanyController');
// Routes for employee CRUD
Route::resource('employee','EmployeeController');


});
