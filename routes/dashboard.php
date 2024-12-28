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
// 'middleware' => 'auth:admin'
Route::group(['prefix' => 'admin'], function () {
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login-admin', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth:admin', 'admin'])->group(function () {
    // مسارات لوحة التحكم الخاصة بالمشرفين
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/in', [SalehController::class, 'internalParts'])->name('dashboard.in');
    Route::get('/dashboard/ex', [SalehController::class, 'externalParts'])->name('dashboard.ex');
    Route::get('/dashboard/el', [SalehController::class, 'electricalParts'])->name('dashboard.el');
    Route::get('/dashboard/allProducts', [SalehController::class, 'allProducts'])->name('dashboard.allProducts');
    Route::get('/dashboard/int', [SalehController::class, 'internalPartsProducts'])->name('dashboard.internalPartsProducts');
    Route::get('/dashboard/ep', [SalehController::class, 'externalPartsProducts'])->name('dashboard.externalPartsProducts');
    Route::get('/dashboard/ele', [SalehController::class, 'electricalPartsProducts'])->name('dashboard.electricalPartsProducts');

    // مسارات الـ SubCategory و الـ Products (المشرف فقط)
    Route::resource('dashboard/subcategories', SubCategoryController::class);
    Route::resource('dashboard/products', ProductController::class);

    // مسارات الـ Makes و الـ Modes (المشرف فقط)
    Route::resource('dashboard/makes', MakeController::class)->names([
        'index' => 'dashboard.makes.index',
        'create' => 'dashboard.makes.create',
        'store' => 'dashboard.makes.store',
        'show' => 'dashboard.makes.show',
        'edit' => 'dashboard.makes.edit',
        'update' => 'dashboard.makes.update',
        'destroy' => 'dashboard.makes.destroy',
    ]);

    Route::resource('dashboard/modes', ModeController::class)->names([
        'index' => 'dashboard.modes.index',
        'create' => 'dashboard.modes.create',
        'store' => 'dashboard.modes.store',
        'show' => 'dashboard.modes.show',
        'edit' => 'dashboard.modes.edit',
        'update' => 'dashboard.modes.update',
        'destroy' => 'dashboard.modes.destroy',
    ]);
});
