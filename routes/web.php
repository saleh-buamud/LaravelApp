<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/internal', [ProductController::class, 'allInternal'])->name('allInternal');
Route::get('/external', [ProductController::class, 'allExternal'])->name('allExternal');
Route::get('/electrical', [ProductController::class, 'allElectrical'])->name('allElectrical');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-cart/{productId}', [CartController::class, 'addCart'])->name('add.cart');
Route::get('/logintest', [UserController::class, 'showLoginForm']);

Route::get('checkout', function () {
    return view('front-ecom-temp.checkout');
})->name('checkout');
Route::post('saveOrder', [CartController::class, 'saveOrder'])->name('saveOrder');

Route::get('sendEmail', [CartController::class, 'sendEmail'])->name('sendEmail');

Route::get('add-quantity/{productId}', [CartController::class, 'addQuantity'])->name('add.quantity');

Route::get('decrease-quantity/{productId}', [CartController::class, 'decreaseQuantity'])->name('decrease.quantity');

Route::get('remove-item/{productId}', [CartController::class, 'removeItem'])->name('remove.item');

Route::get('clear', [CartController::class, 'clearCart'])->name('clear'); // Route::get('/all', [ProductController::class, 'AllProduct'])->name('home');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/product-details', function () {
    return view('front-ecom-temp.product-details');
})->name('product-details');

Route::get('/to', function () {
    $All = User::all();

    dd($All);
});

/////////////////////////
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
