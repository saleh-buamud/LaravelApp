<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubCategoryController;

/*
|--------------------------------------------------------------------------
| SubCategory API Routes
|--------------------------------------------------------------------------
|
| Here are the subcategory-related API routes for the application.
| These routes handle subcategory listing and retrieval.
|
*/

Route::prefix('subcategories')->group(function () {
    // Public subcategory routes
    Route::get('/', [SubCategoryController::class, 'index']);
    Route::get('/category/{categoryId}', [SubCategoryController::class, 'getByCategory']);
    Route::get('/{id}', [SubCategoryController::class, 'show']);
});
