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

Route::get('/test', 'PagesController@test');

Route::get('/employees/{json?}','EmployeesController@index');

Route::get('/shifts/{weeknum?}/{json?}', 'ShiftsController@get_week');

Route::get('/test/create_week', 'ShiftsController@create_week');
