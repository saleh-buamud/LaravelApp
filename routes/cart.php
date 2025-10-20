<?php

use App\Http\Controllers\Front\CartController;
use Illuminate\Support\Facades\Route;

/**
 * Cart and order related routes
 */
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-cart/{productId}', [CartController::class, 'addCart'])->name('add.cart');
Route::get('add-quantity/{productId}', [CartController::class, 'addQuantity'])->name('add.quantity');
Route::get('decrease-quantity/{productId}', [CartController::class, 'decreaseQuantity'])->name('decrease.quantity');
Route::get('remove-item/{productId}', [CartController::class, 'removeItem'])->name('remove.item');
Route::get('clear', [CartController::class, 'clearCart'])->name('clear');
Route::post('saveOrder', [CartController::class, 'saveOrder'])->name('saveOrder');
Route::get('sendEmail', [CartController::class, 'sendEmail'])->name('sendEmail');
