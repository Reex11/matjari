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

Route::resource('employees', 'EmployeesController');
Route::resource('rewards', 'RewardsController');
Route::resource('salaries', 'SalariesController');

Route::get('/salaries/employee/{id}', 'SalariesController@listByEmployee');
Route::get('/salaries/{year}/{month}', 'SalariesController@listByMonth');
Route::get('/test/create/{year}/{month}/{employee}', 'SalariesController@create');
Route::post('/salaries/createmonth', 'SalariesController@createMonth');
Route::get('/salaries/createmonth/{year}/{month}', 'SalariesController@createMonth');



Route::get('/shifts/create/{table?}/{year?}/{weeknum?}/{fromyear?}/{fromweeknum?}', 'ShiftsController@create');
Route::get('/shifts/{table}/{year}/{weeknum}/edit', 'ShiftsController@edit');
Route::patch('/shifts/{table}/{year}/{weeknum}', 'ShiftsController@update');
Route::get('/shifts/{table?}/{year?}/{weeknum?}', 'ShiftsController@show');

//Route::get('/test/create_week', 'ShiftsController@create_week');
