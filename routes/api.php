<?php

use App\Http\Controllers\AuthContractorController;
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
    });
});
