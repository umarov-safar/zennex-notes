<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('only_guest')
    ->prefix('auth')
    ->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);

        Route::resource('notes', NoteController::class)->except(['index']);
        Route::post('notes:search', [NoteController::class, 'index']);

        Route::resource('tags', TagController::class);
    });
