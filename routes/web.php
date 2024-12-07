<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;

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
Route::get('/electrical', [ProductController::class, 'electricalPartsProducts'])->name('allEx');

// Route::get('/all', [ProductController::class, 'AllProduct'])->name('home');

Route::get('/product-details', function () {
    return view('front-ecom-temp.product-details');
})->name('product-details');

/////////////////////////
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
