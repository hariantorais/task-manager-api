<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('boards', App\Http\Controllers\BoardController::class);
    Route::apiResource('task-lists', App\Http\Controllers\TaskListController::class);
    Route::apiResource('cards', App\Http\Controllers\CardController::class);
    Route::put('/cards/{id}/move', [App\Http\Controllers\CardController::class, 'move']);
    Route::apiResource('users', \App\Http\Controllers\UserController::class);


});


