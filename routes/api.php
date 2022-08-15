<?php

use App\Http\Controllers\AuthContractorController;
use App\Http\Controllers\AuthForemanController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ProjectController;
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
            Route::get('me', [AuthContractorController::class, 'me']);
            Route::post('update', [AuthContractorController::class, 'update']);
            Route::post('logout', [AuthContractorController::class, 'logout']);
        });
    });

    Route::prefix('foreman')->group(function () {
        Route::get('search', [ContractorController::class, 'searchForeman']);
        Route::get('recommendation', [ContractorController::class, 'recommendationForeman']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('detail/{id}', [ContractorController::class, 'detailForeman']);
            Route::get('wishlist', [ContractorController::class, 'wishlistForeman']);
            Route::post('wishlist', [ContractorController::class, 'addWishlistForeman']);
            Route::delete('wishlist', [ContractorController::class, 'removeWishlistForeman']);
        });
    });

    Route::prefix('project')->group(function () {
        Route::get('detail/{id}', [ProjectController::class, 'detailProject']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('list', [ProjectController::class, 'listProject']);
            Route::post('create', [ProjectController::class, 'createProject']);
            Route::post('cancel', [ProjectController::class, 'cancelProject']);
            Route::post('payment', [ProjectController::class, 'paymentProject']);
        });
    });
});

Route::prefix('foreman')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthForemanController::class, 'register']);
        Route::post('login', [AuthContractorController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthContractorController::class, 'logout']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthForemanController::class, 'me']);
    });

    Route::prefix('project')->group(function () {
        Route::get('detail/{id}', [ProjectController::class, 'detailProject']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('list', [ProjectController::class, 'listProject']);
            Route::post('accept', [ProjectController::class, 'acceptProject']);
            Route::post('reject', [ProjectController::class, 'rejectProject']);
            Route::post('report', [ProjectController::class, 'reportProject']);
        });
    });
});

