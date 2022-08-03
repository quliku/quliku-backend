<?php

use App\Http\Controllers\AuthContractorController;
use App\Http\Controllers\AuthForemanController;
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

Route::prefix('contractor')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthContractorController::class, 'register']);
        Route::post('login', [AuthContractorController::class, 'login']);
        Route::get('unauthenticated', [AuthContractorController::class, 'unauthenticated'])->name('login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthContractorController::class, 'logout']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthContractorController::class, 'me']);
    });
});

Route::prefix('foreman')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthForemanController::class, 'register']);
        Route::post('login', [AuthContractorController::class, 'login']);
    });
});

