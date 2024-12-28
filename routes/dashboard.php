<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalehController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

// Grouping all admin routes with the 'admin' prefix
Route::group(['prefix' => 'admin'], function () {
    // Show the registration form for the admin
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    // Handle the registration process for the admin
    Route::post('register', [AdminAuthController::class, 'register']);

    // Show the login form for the admin
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Handle the login process for the admin (POST request)
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Handle the logout process for the admin
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Group routes with 'auth:admin' middleware to protect routes for authenticated admins only
// Also using 'admin' middleware for additional permission checks
Route::middleware(['auth:admin', 'admin'])->group(function () {
    // Dashboard route for viewing all admins (restricted to admins only)
    Route::get('/dashboard/admin', [AdminController::class, 'allAdmin'])->name('dashboard.allAdmin');
    // Resource route for managing admins (CRUD operations for admins)
    Route::resource('admin', AdminController::class)->middleware(['auth', 'check.permissions:can_create_users']);
    // Dashboard routes for the different sections of the application
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/in', [SalehController::class, 'internalParts'])->name('dashboard.in');
    Route::get('/dashboard/ex', [SalehController::class, 'externalParts'])->name('dashboard.ex');
    Route::get('/dashboard/el', [SalehController::class, 'electricalParts'])->name('dashboard.el');
    Route::get('/dashboard/allProducts', [SalehController::class, 'allProducts'])->name('dashboard.allProducts');
    Route::get('/dashboard/int', [SalehController::class, 'internalPartsProducts'])->name('dashboard.internalPartsProducts');
    Route::get('/dashboard/ep', [SalehController::class, 'externalPartsProducts'])->name('dashboard.externalPartsProducts');
    Route::get('/dashboard/ele', [SalehController::class, 'electricalPartsProducts'])->name('dashboard.electricalPartsProducts');

    // Resource routes for managing SubCategories and Products (admin only)
    Route::resource('dashboard/subcategories', SubCategoryController::class);
    Route::resource('dashboard/products', ProductController::class);

    // Resource routes for managing Makes (admin only)
    Route::resource('dashboard/makes', MakeController::class)->names([
        'index' => 'dashboard.makes.index', // View all Makes
        'create' => 'dashboard.makes.create', // Show form to create a new Make
        'store' => 'dashboard.makes.store', // Handle storing the new Make
        'show' => 'dashboard.makes.show', // View a single Make
        'edit' => 'dashboard.makes.edit', // Show form to edit an existing Make
        'update' => 'dashboard.makes.update', // Handle updating the Make
        'destroy' => 'dashboard.makes.destroy', // Handle deleting a Make
    ]);

    // Resource routes for managing Modes (admin only)
    Route::resource('dashboard/modes', ModeController::class)->names([
        'index' => 'dashboard.modes.index', // View all Modes
        'create' => 'dashboard.modes.create', // Show form to create a new Mode
        'store' => 'dashboard.modes.store', // Handle storing the new Mode
        'show' => 'dashboard.modes.show', // View a single Mode
        'edit' => 'dashboard.modes.edit', // Show form to edit an existing Mode
        'update' => 'dashboard.modes.update', // Handle updating the Mode
        'destroy' => 'dashboard.modes.destroy', // Handle deleting a Mode
    ]);
});
