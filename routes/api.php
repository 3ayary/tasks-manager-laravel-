<?php

use App\Http\Controllers\profileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;


Route::get('/login',[userController::class,'login']);
Route::post('/register',[userController::class,'register']);
Route::get('/logout',[userController::class,'logout'])->middleware('auth:sanctum'); 

Route::get('/users', [userController::class, 'getAllUsers']);
Route::get('/user', [userController::class, 'getOneUser'])->middleware('auth:sanctum');
Route::get('/users/profile',[userController::class,'getProfile'])->middleware('auth:sanctum');
Route::get('/users/tasks',[userController::class,'getUserTasks'])->middleware('auth:sanctum');


Route::post('/tasks', [TaskController::class, 'createTask'])->middleware('auth:sanctum');
Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask'])->middleware('auth:sanctum');
Route::get('/tasks/{id}', [TaskController::class, 'findOne']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->middleware('auth:sanctum');
Route::get('/tasks/{id}/user',[TaskController::class,'getTaskUser']);

Route::post('/profile', [profileController::class, 'CreateProfile'])->middleware('auth:sanctum');

Route::post('/tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);

Route::get('/tasks/{taskId}/categories',[TaskController::class,'getTaskCategories']);

Route::get('/categories/{categoryId}/tasks',[TaskController::class,'getCategoriesTasks']);



