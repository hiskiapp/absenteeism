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
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

//Middleware
Route::group(['middleware' => 'auth'], function () {
	// Home
	Route::get('/','DashboardController@getIndex');

	// Students Module
	routeController('students','StudentsController');

	// Teachers Module
	routeController('teachers','TeachersController');

	// Employees Module
	// routeController('employees','EmployeesController');

	// Rombels Module
	routeController('rombels','RombelsController');

	// Rayons Module
	routeController('rayons','RayonsController');

	// Absensi Siswa
	routeController('absent/students','AbsentStudentsController');
	// Absensi Siswa
	routeController('absent/teachers','AbsentTeachersController');

	// Log Activity
	routeController('settings','SettingsController');

	// Holiday
	routeController('holiday','HolidaysController');

	// Log Activity
	routeController('log_activity','LogsController');

	// Users Module
	routeController('users','UsersController');
});