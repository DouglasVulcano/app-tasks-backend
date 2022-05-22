<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

/** Login route */
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


/** Tasks routes */
Route::controller(TasksController::class)->middleware('auth:sanctum')->prefix('tasks')
    ->group(
        function () {
            Route::get('/list-user-tasks', 'index')->where('userId', '[0-9]+');
            Route::get('/show-task', 'show')->where('id', '[0-9]+');
            Route::get('/last-task', 'showLastTask');
            Route::post('/post-task', 'post');
            Route::put('/update-task', 'updateTask')->where('id', '[0-9]+');
            Route::patch('/update-task-status', 'updateTaskStatus')->where('id', '[0-9]+');
            Route::delete('/delete-task', 'delete')->where('id', '[0-9]+');
        }
    );
