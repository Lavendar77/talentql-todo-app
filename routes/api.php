<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\User\AccountController;
use App\Http\Controllers\API\User\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('', [AccountController::class, 'index']);
        Route::post('logout', [AccountController::class, 'logout']);
    });

    Route::prefix('tasks')->group(function () {
        Route::get('', [TaskController::class, 'index']);
        Route::post('', [TaskController::class, 'store']);
        Route::get('{task}', [TaskController::class, 'show']);
        Route::patch('{task}', [TaskController::class, 'update']);
        Route::delete('{task}', [TaskController::class, 'destroy']);
    });
});
