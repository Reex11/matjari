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
Route::resource('rewards', 'RewardsController');


Route::get('/shifts/create/{year?}/{weeknum?}/{fromyear?}/{fromweeknum?}', 'ShiftsController@create');
Route::get('/shifts/{year}/{weeknum}/edit', 'ShiftsController@edit');
Route::patch('/shifts/{year}/{weeknum}', 'ShiftsController@update');
Route::get('/shifts/{year?}/{weeknum?}', 'ShiftsController@show');
//Route::get('/test/create_week', 'ShiftsController@create_week');
