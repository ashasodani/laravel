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
Route::get('/bootstrap', function () {
    return view('layout.a_ashh');
});
Route::get('/mapssss', function () {
    return view('employee.longi');
});

Route::get('/maptest', function () {
    return view('employee.longi_as');
});

Route::get('/maps','EmployeeController@maps');


Route::get('add', 'EmployeeController@index');
Route::get('employee','EmployeeController@create')->name('employee');
Route::post('employee','EmployeeController@store')->name('employee');
Route::get('employee_edit/{id}',['uses' =>'EmployeeController@edit']);
Route::post('employee_update/{id}','EmployeeController@update');
Route::get('employee_delete/{id}','EmployeeController@destroy');

Route::get('/abc','EmployeeController@abc');
Route::post('/updatess','EmployeeController@updatess');
Route::get('/deletess','EmployeeController@deletess');


Route::post( '/', 'EmployeeController@readitems' );
//Route::get ( '/', 'EmployeeController@readItems' );

Route::get('/datefilter','EmployeeController@datefilter');
Route::get('/yestoday','EmployeeController@yestoday');