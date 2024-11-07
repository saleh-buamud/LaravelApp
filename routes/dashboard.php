<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalehController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/dashboard/in', [SalehController::class, 'internalParts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.in');
Route::get('/dashboard/ex', [SalehController::class, 'externalParts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.ex');
Route::get('/dashboard/el', [SalehController::class, 'electricalParts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.el');
Route::get('/dashboard/allProducts', [SalehController::class, 'allProducts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.allProducts');

Route::get('/dashboard/int', [SalehController::class, 'internalPartsProducts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.internalPartsProducts');
Route::get('/dashboard/ep', [SalehController::class, 'externalPartsProducts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.externalPartsProducts');
Route::get('/dashboard/ele', [SalehController::class, 'electricalPartsProducts'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.electricalPartsProducts');

// Route::get('/dashboard/check', [SubCategoryController::class, 'check'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard.electricalPartsProducts');
Route::get('/subcategories/{id}/products', [SalehController::class, 'productsBySubCategory'])->name('subcategories.products');

// Route::resource('dashboard/categories', CategoriesController::class)->middleware('auth');
Route::resource('dashboard/subcategories', SubCategoryController::class)->middleware('auth');
Route::resource('dashboard/products', ProductController::class)->middleware('auth');
