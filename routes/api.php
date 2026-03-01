<?php

use App\Http\Controllers\profileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [userController::class, 'getAllUsers'])->middleware('auth:sanctum');
Route::get('/user/{id}', [userController::class, 'getOneUser']);
Route::get('/users/{id}/profile',[userController::class,'getProfile']);
Route::get('/users/{id}/tasks',[userController::class,'getUserTasks']);


Route::post('/tasks', [TaskController::class, 'createTask']);
Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::get('/tasks/{id}', [TaskController::class, 'findOne']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);
Route::get('/tasks/{id}/user',[TaskController::class,'getTaskUser']);

Route::post('/profile', [profileController::class, 'CreateProfile']);

Route::post('/tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);

Route::get('/tasks/{taskId}/categories',[TaskController::class,'getTaskCategories']);

Route::get('/categories/{categoryId}/tasks',[TaskController::class,'getCategoriesTasks']);


Route::get('/login',[userController::class,'login']);
Route::post('/register',[userController::class,'register']);
Route::get('/logout',[userController::class,'logout'])->middleware('auth:sanctum'); 



