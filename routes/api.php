<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardCommentController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('task-lists', TaskListController::class);
    Route::apiResource('cards', CardController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('card-users', CardUserController::class);
    Route::apiResource('card-comments', CardCommentController::class);

    Route::put('/cards/{id}/move', [CardController::class, 'move']);
    Route::post('/users/search', [UserController::class, 'search']);
    Route::post('/card-users/delete-member', [CardUserController::class, 'deleteMember']);
    Route::get('/card-users/get-card-members/{id}', [CardUserController::class, 'getCardMembers']);
});


