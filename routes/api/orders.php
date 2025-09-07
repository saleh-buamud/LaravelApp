<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| Order API Routes
|--------------------------------------------------------------------------
|
| Here are the order-related API routes for the application.
| These routes handle order management and require authentication.
|
*/

// User authentication route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Protected order routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/user/{userId}', [OrderController::class, 'getByUser']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::patch('/{id}/status', [OrderController::class, 'updateStatus']);
        Route::delete('/{id}', [OrderController::class, 'destroy']);
    });
});
