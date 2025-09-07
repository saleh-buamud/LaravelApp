<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| Category API Routes
|--------------------------------------------------------------------------
|
| Here are the category-related API routes for the application.
| These routes handle category listing and retrieval.
|
*/

Route::prefix('categories')->group(function () {
    // Public category routes
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
});
