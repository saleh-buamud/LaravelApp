<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SubCategoryController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend routes: home, categories, product pages, and static pages
 */

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// SubCategory Routes
Route::get('/internal', [SubCategoryController::class, 'allInternal'])->name('allInternal');
Route::get('/external', [SubCategoryController::class, 'allExternal'])->name('allExternal');
Route::get('/electrical', [SubCategoryController::class, 'allElectrical'])->name('allElectrical');

// Product Routes
Route::get('sub-category/{subCategoryId}/products', [ProductController::class, 'showProductsBySubCategory'])->name('subCategory.products');
Route::get('/product/{productId}', [ProductController::class, 'showProduct'])->name('product-details');
Route::get('/search', [ProductController::class, 'search'])->name('products.search.front');

// Static / demo pages (kept here for convenience)
Route::get('pyment', function () {
    return view('front-ecom-temp.pyment'); })->name('pyment');
Route::get('type', function () {
    return view('front-ecom-temp.type-1'); })->name('type-1');
Route::get('typeall', function () {
    return view('front-ecom-temp.type-2'); })->name('type-2');
Route::get('typeafeza', function () {
    return view('front-ecom-temp.type-3'); })->name('type-3');
Route::get('checkout', function () {
    return view('front-ecom-temp.checkout'); })->name('checkout');
Route::get('about', function () {
    return view('front-ecom-temp.about'); })->name('about');
Route::get('/product-details', function () {
    return view('front-ecom-temp.product-details'); })->name('product-details');
