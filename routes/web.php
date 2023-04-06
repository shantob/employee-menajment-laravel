<?php

use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFeaturesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', function () {
    
    if(auth()->check()) {
        return redirect()->route('home');
    }

    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{user}', [UserController::class, 'update'])->name('update');
    });

    //======================>> Employees <<=================================//
   // Route::get('profile/{employee}', [EmployeeController::class, 'profile'])->name('employee.profile');
    Route::group(['middleware' => 'adminAccess', 'prefix' => 'employee', 'as' => 'employee.'], function () {
        Route::get('/', [EmployeeController::class, 'Index'])->name('index');
        Route::get('create', [EmployeeController::class, 'create'])->name('create');
        Route::post('store', [EmployeeController::class, 'store'])->name('store');
        Route::get('edit/{employee}', [EmployeeController::class, 'edit'])->name('edit');
        Route::patch('update/{employee}', [EmployeeController::class, 'update'])->name('update');
        Route::patch('{id}/delete', [EmployeeController::class, 'delete'])->name('delete');
    });
    //======================>> Employees <<=================================//


    //======================>> Attendence <<=================================//
    Route::group(['prefix' => 'attendence', 'as' => 'attendence.'], function () {
        
        Route::get('/', [AttendenceController::class, 'index'])->name('index');
        Route::get('monthly', [AttendenceController::class, 'monthlyReports'])->name('monthly');
        Route::get('end/{user}', [AttendenceController::class, 'end'])->name('end');
        
        Route::middleware(['adminAccess'])->group(function () {
            Route::get('create', [AttendenceController::class, 'create'])->name('create');
            Route::post('store', [AttendenceController::class, 'store'])->name('store');
            Route::get('start/{user}', [AttendenceController::class, 'start'])->name('start');
        });
    });
    //======================>> Attendence <<=================================//
    

    //======================>> Projects <<=================================//
    Route::get('/project', [ProjectController::class, 'Index'])->name('project.index');
    Route::group(['middleware' => 'adminAccess', 'prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [ProjectController::class, 'update'])->name('update');
        Route::patch('/{id}/delete', [ProjectController::class, 'delete'])->name('delete');
    });
    //======================>> Projects <<=================================//

    // project_feature 
    Route::get('/project_feature', [ProjectFeaturesController::class, 'Index'])->name('project_feature.index');
    Route::group(['middleware' => 'adminAccess', 'prefix' => 'project_feature', 'as' => 'project_feature.'], function () {
        Route::get('/create', [ProjectFeaturesController::class, 'create'])->name('create');
        Route::post('/store', [ProjectFeaturesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectFeaturesController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [ProjectFeaturesController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [ProjectFeaturesController::class, 'delete'])->name('delete');
    });

    //======================>> Tasks <<=================================//
    Route::get('/task', [TaskController::class, 'Index'])->name('task.index');
    Route::post('task/store', [TaskController::class, 'store'])->name('task.store');
    Route::group(['middleware' => 'adminAccess', 'prefix' => 'task', 'as' => 'task.'], function () {
        Route::get('create', [TaskController::class, 'create'])->name('create');
        Route::get('edit/{id}', [TaskController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [TaskController::class, 'updateStatus'])->name('update');        
        Route::post('update/status', [TaskController::class, 'update_task'])->name('update_task');
    });
    //======================>> Tasks <<=================================//

    // job Title 
    Route::group(['middleware' => 'adminAccess'], function () {
        Route::get('/job', [JobController::class, 'Index'])->name('job.index');
        Route::post('job_title/store', [JobController::class, 'job_title_store'])->name('jobTitle.store');
        Route::post('job_level/store', [JobController::class, 'job_level_store'])->name('jobLevel.store');
    });
    
    // expenses
    Route::group(['middleware' => 'adminAccess', 'prefix' => 'expenses'], function () {
        Route::get('/', [ExpensesController::class, 'Index'])->name('expenses.index');
        Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
        Route::post('expenses_type/store', [ExpensesController::class, 'expenses_type_store'])->name('expenses_type.store');
        Route::post('/store', [ExpensesController::class, 'expenses_store'])->name('expenses.store');
        Route::get('/{id}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
        Route::patch('/{id}/update', [ExpensesController::class, 'update'])->name('expenses.update');

    });

    //======================>> leave <<=================================//
    Route::get('/leave', [EmployeeLeaveController::class, 'index'])->name('leave.index');
    Route::post('leave/store', [EmployeeLeaveController::class, 'store'])->name('leave.store');
    Route::post('leave/update', [EmployeeLeaveController::class, 'update'])->name('leave.update');        
    Route::post('leave/update/status', [EmployeeLeaveController::class, 'statusUpdate'])->name('leave.update.status');        
    // Route::group(['middleware' => 'adminAccess', 'prefix' => 'leave', 'as' => 'leave.'], function () {
    // });
    //======================>> leave <<=================================//
    
});
    
    
    Route::get('error-404', function () {
        return view('404');
    })->name('error-404');
