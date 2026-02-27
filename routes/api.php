<?php

use App\Http\Controllers\profileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', [welcomeController::class, 'getWelcome']);
Route::get('/users', [userController::class, 'getAllUsers']);
Route::get('/user/{id}', [userController::class, 'getOneUser']);

Route::post('/tasks', [TaskController::class, 'createTask']);
Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::get('/tasks/{id}', [TaskController::class, 'findOne']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);

Route::post('/profile', [profileController::class, 'CreateProfile']);


Route::get('/users/{id}/profile',[userController::class,'getProfile']);

Route::get('/users/{id}/tasks',[userController::class,'getUserTasks']);


Route::get('/tasks/{id}/user',[TaskController::class,'getTaskUser']);
