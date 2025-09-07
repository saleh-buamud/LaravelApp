<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| Product API Routes
|--------------------------------------------------------------------------
|
| Here are the product-related API routes for the application.
| These routes handle product listing, searching, and retrieval.
|
*/

Route::prefix('products')->group(function () {
    // Public product routes
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/low-stock', [ProductController::class, 'lowStock']);
    Route::get('/sub-category/{subCategoryId}', [ProductController::class, 'getBySubCategory']);
    Route::get('/{id}', [ProductController::class, 'show']);
});
