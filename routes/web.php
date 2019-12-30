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

// API
routeController('api','ApiController');

// Auth
Auth::routes();

//Middleware
Route::group(['middleware' => 'auth'], function () {
	// Home
	Route::get('/','DashboardController@getIndex');

	// Students Module
	routeController('students','StudentsController');

	// Teachers Module
	routeController('teachers','TeachersController');

	// Employees Module
	routeController('employees','EmployeesController');

	// Rombels Module
	routeController('rombels','RombelsController');

	// Rayons Module
	routeController('rayons','RayonsController');

	// Absensi
	routeController('absent','AbsentController');

	// Log Activity
	routeController('settings','SettingsController');

	// Log Activity
	routeController('log_activity','LogsController');

	// Users Module
	routeController('users','UsersController');
});