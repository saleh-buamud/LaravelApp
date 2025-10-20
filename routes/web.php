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

// Split route files for organization
require __DIR__ . '/front.php';
require __DIR__ . '/cart.php';
require __DIR__ . '/debug.php';

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
