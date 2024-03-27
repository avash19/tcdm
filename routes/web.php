<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientCustomerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\OfficeHourController;

// ======================== ROUTING ==================================
Route::get('/', [UserController::class,'getLoginPage'])->name('/');
Route::get('/user/check/active', [UserController::class,'checkActive']);

// ========== LOGIN USER
Route::post('/login',[UserController::class ,'login'])->name('login');

//EVENTS
Route::get('/events/get/{filter}',[EventController::class ,'getEvents']);
Route::get('/events/get-event-data/{by}',[EventController::class ,'getTask']);
Route::put('/events/bulk-assign',[EventController::class,'bulkAssignEvents']);
Route::get('/users-getname/{user}',[UserController::class,'getEmpName']);

Route::middleware(['auth'])->group(function(){

	Route::get('/logout',[UserController::class ,'logout']);
	
	// ALL ABOUT PROFILE INFO
	Route::get('/profile',[UserController::class,'profile']);

	Route::put('/profile',[UserController::class,'updateProfile']);

	// ALL ABOUT EVENTS
	Route::resource('/events',EventController::class);

	// ALL ABOUT ATTENDANCE
	Route::resource('/attendances',AttendanceController::class);
});
// ========== ALL ABOUT ADMIN
Route::middleware(['auth','adminAuth'])->group(function(){
	Route::get('/admin/dashboard',[UserController::class,'getAdminDashboard']);

	Route::get('/get-data',[UserController::class,'getChartData']);

	// ALL ABOUT EMPLOYEE
	Route::resource('/admin/employee',AdminController::class);
	Route::get('/admin/employee/details/{by}',[AdminController::class,'activeBreakEmployee']);

	// ALL ABOUT CLIENT
	Route::resource('/clients',ClientController::class);

	Route::get('/clients/{client}/csv',[ClientController::class,'getCsv']);

	// ALL ABOUT CLIENT CUSTOMER
	Route::resource('/customers',ClientCustomerController::class);
	Route::get('/customers/create/{client}',[ClientCustomerController::class,'create']);

	// ALL ABOUT EVENTS
	Route::get('/events/{id}/{by}',[EventController::class,'getEventAccordingToTask']);
	Route::put('/events/{event}/{by}',[EventController::class,'updateEventAccordingToTask']);
	Route::get('/events-assign-tasks',[EventController::class,'assignTasks']);
	Route::get('/events/filter/{date}',[EventController::class,'filterEvent']);
	Route::put('/events/unassign/{event}/{user}',[EventController::class,'unassignTask']);

	// // ALL ABOUT OFFICE-HOURS
	// 	Route::resource('/officehours',OfficeHourController::class);


	// Route::get('/attendances/foradmin',[AttendanceController::class,'getAttendances']);
});

// ========== ALL ABOUT EMPLOYEE
Route::middleware(['auth','employeeAuth'])->group(function(){
	Route::get('/employee/dashboard',[UserController::class,'getEmployeeDashboard']);

	// ALL ABOUT EMPLOYEE TASK
	Route::resource('/employee/tasks',EmployeeController::class);
	Route::get('/employee/events/rejects/{id}/{event}',[EmployeeController::class,'rejectTask']);
	Route::get('/employee/events/{id}/{event}/edit',[EmployeeController::class,'edit']);
	Route::get('/employee/events/{id}/{event}/add',[EmployeeController::class,'add']);
	Route::get('/employee/events/tasks/{by}',[EmployeeController::class,'getEventTasks']);

});

// Route::get('test',function($message){
// 	event(new App\Events\NotificationAlert($message));
// });

// Route::get(uri:'/', action: 'App\Http\PusherController@index');
// Route::post(uri:'/', broadcast: 'App\Http\PusherController@broadcast');
// Route::post(uri:'/', receive: 'App\Http\PusherController@receive');
