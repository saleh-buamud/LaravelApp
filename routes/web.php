<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\SubCategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Auth\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// SubCategory Routes
Route::get('/internal', [SubCategoryController::class, 'allInternal'])->name('allInternal');
Route::get('/external', [SubCategoryController::class, 'allExternal'])->name('allExternal');
Route::get('/electrical', [SubCategoryController::class, 'allElectrical'])->name('allElectrical');

// Product Routes
Route::get('sub-category/{subCategoryId}/products', [ProductController::class, 'showProductsBySubCategory'])->name('subCategory.products');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

// Cart Routes
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-cart/{productId}', [CartController::class, 'addCart'])->name('add.cart');
Route::get('add-quantity/{productId}', [CartController::class, 'addQuantity'])->name('add.quantity');
Route::get('decrease-quantity/{productId}', [CartController::class, 'decreaseQuantity'])->name('decrease.quantity');
Route::get('remove-item/{productId}', [CartController::class, 'removeItem'])->name('remove.item');
Route::get('clear', [CartController::class, 'clearCart'])->name('clear');
Route::post('saveOrder', [CartController::class, 'saveOrder'])->name('saveOrder');

///////////////////////
Route::get('pyment', function () {
    return view('front-ecom-temp.pyment');
})->name('pyment');

Route::get('type', function () {
    return view('front-ecom-temp.type-1');
})->name('type-1');

Route::get('typeall', function () {
    return view('front-ecom-temp.type-2');
})->name('type-2');

Route::get('typeafeza', function () {
    return view('front-ecom-temp.type-3');
})->name('type-3');

///////////////////
Route::get('sendEmail', [CartController::class, 'sendEmail'])->name('sendEmail');

// Search products
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/product/{productId}', [ProductController::class, 'showProduct'])->name('product-details');
// Checkout Route
Route::get('checkout', function () {
    return view('front-ecom-temp.checkout');
})->name('checkout');

// Static Pages
Route::get('about', function () {
    return view('front-ecom-temp.about');
})->name('about');

Route::get('/product-details', function () {
    return view('front-ecom-temp.product-details');
})->name('product-details');

// Debugging Route - To retrieve all users
Route::get('/to', function () {
    $All = User::all();
    dd($All);
});

// Authentication Routes (Profile Management)
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication and Dashboard Routes (Includes login and registration)
require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
