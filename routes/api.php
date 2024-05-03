<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUserController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//Login User API
Route::post('login', [ApiLoginController::class, 'login']);

//Get all Users 
Route::get('users', [UserController::class, 'index']);

//Create Task API
Route::post('create-task', [TaskController::class, 'add']);

//Get all Tasks API
Route::get('get-all-tasks', [TaskController::class, 'get_tasks']);

// Update tasks Title, Description and Status
Route::put('/tasks/{taskId}', [TaskController::class, 'updateTask']);

// Delete task by ID
Route::delete('/tasks/{taskId}', [TaskController::class, 'deleteTask']);


//Assign a user to a task by giving user and task id
Route::post('/task-users', [TaskUserController::class, 'store']);

//Unassign user to a task by user and task id
Route::delete('/task-users/{taskUserId}', [TaskUserController::class, 'unassignTaskUser']);


//Get all task user relations
Route::get('/get-task-user', [TaskUserController::class, 'getAllTaskUser']);


// Get tasks by status
Route::get('/tasks', [TaskController::class, 'getTasksByStatus']);

// Get tasks by date
Route::get('/tasks/by-date', [TaskController::class, 'getTasksByDate']);

//Get tasks by assigned user
Route::get('/tasks/by-assigned-user', [TaskController::class, 'getTasksByAssignedUser']);

Route::get('/tasks/assigned', [TaskController::class, 'getLoggedinUserTask']);



