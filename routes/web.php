<?php

// routes/web.php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication-related routes
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes (protected by 'auth' middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/choose', [RoleController::class, 'assignForm'])->name('roles.choose');
    Route::post('/roles/choose/{roleId}', [RoleController::class, 'chooseRole'])->name('roles.chooseRole');

    Route::get('/users', [LoginController::class, 'index'])->name('users.index');

    Route::get('/users/admin', [UserController::class, 'admin'])->name('users.admin.admin');
    Route::get('/users/manager', [UserController::class, 'manager'])->name('users.manager');
    Route::get('/users/member', [UserController::class, 'member'])->name('users.member');

// Change the route name to be more descriptive
    Route::get('/users/assigned-tasks', [UserController::class, 'assignedTasks'])->name('users.assigned_tasks');

// Change the route name to be more descriptive
    Route::get('/users/member/tasks', [UserController::class, 'memberTasks'])->name('users.member_tasks');

// Adjust the route name and method name for better clarity
    Route::get('/users/member/tasks/{taskId}', [UserController::class, 'showTaskDetails'])->name('users.member.task_details');
    Route::post('/users/member/tasks/{taskId}/complete', [UserController::class, 'completeTask'])->name('users.member.complete_task');


    Route::patch('/users/assigned-tasks/{taskId}/update-status', [UserController::class, 'updateTaskStatus'])
        ->name('update_task_status');

// routes/web.php


    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('users/create_task', [AdminController::class, 'createTask'])->name('users.admin.create_task');
        Route::get('/view_users', [AdminController::class, 'viewUsers'])->name('users.admin.view_users');
        Route::post('/task/submit', [AdminController::class, 'submitTask'])->name('users.admin.task.submit');
        Route::get('/view/task_assigned', [AdminController::class, 'viewTaskAssigned'])->name('users.admin.view.task_assigned');
        Route::get('/task_assign', [AdminController::class, 'showAssignTaskForm'])->name('users.admin.task_assign');
        Route::post('/task_assign', [AdminController::class, 'assignTask'])->name('users.admin.assignTask');
        Route::delete('/tasks/{id}', 'AdminController@deleteTask')->name('users.admin.task.delete');


    });




    Route::get('/assigned-tasks', [TaskController::class, 'assignedTasks'])->name('assigned_tasks.blade.php');
    Route::post('/users/assigned-tasks/{taskId}/update-status', [UserController::class, 'updateTaskStatus'])
        ->name('users.assigned_tasks.update_status');
    });




//Route::middleware(['auth', 'admin'])->group(function () {
//        Route::get('/create_task', [AdminController::class, 'createTask'])->name('create_task');
//        Route::get('/view_users', [AdminController::class, 'viewUsers'])->name('view_users');
//        Route::post('/task/submit', [AdminController::class, 'submitTask'])->name('task.submit');
//        Route::get('/view/task_assigned', [AdminController::class, 'viewTaskAssigned'])->name('view.task_assigned');
//        Route::get('/task_assign', [AdminController::class, 'showAssignTaskForm'])->name('task_assign'); // Change here
//        Route::post('/task_assign', [AdminController::class, 'assignTask'])->name('assignTask');
//        Route::get('/admin/view/task_assigned', [AdminController::class, 'viewTaskAssigned'])->name('users.admin.view_task_assigned');
//    });

