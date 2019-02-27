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

Route::get('/', 'PagesController@index');



// Route::get('/employees/create','EmployeesController@create');
// Route::post('/employees','EmployeesController@store');

// Route::get('/employees/{json?}/edit','EmployeesController@edit');
// Route::patch('/employees/{json?}','EmployeesController@update');

// Route::get('/employees','EmployeesController@index');
// Route::get('/employees/{employee}','EmployeesController@view');

Route::resource('employees', 'EmployeesController');

Route::patch('/shifts/{year}/{weeknum}', 'ShiftsController@update_week');
Route::get('/shifts/{year}/{weeknum}/edit', 'ShiftsController@edit_week');
Route::get('/shifts/{year?}/{weeknum?}/{json?}', 'ShiftsController@view_week');

Route::get('/test/create_week', 'ShiftsController@create_week');
