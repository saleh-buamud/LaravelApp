<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| Cart API Routes
|--------------------------------------------------------------------------
|
| Here are the cart-related API routes for the application.
| These routes handle shopping cart operations.
|
*/

Route::prefix('cart')->group(function () {
    // Public cart routes
    Route::get('/', [CartController::class, 'index']);
    Route::get('/summary', [CartController::class, 'summary']);
    Route::post('/add/{productId}', [CartController::class, 'add']);
    Route::put('/update/{productId}', [CartController::class, 'update']);
    Route::delete('/remove/{productId}', [CartController::class, 'remove']);
    Route::delete('/clear', [CartController::class, 'clear']);
});
