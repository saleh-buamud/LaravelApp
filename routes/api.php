<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| The routes are organized into separate files by domain for better
| maintainability and clean architecture.
|
*/

// Include domain-specific route files
require __DIR__ . '/api/products.php';
require __DIR__ . '/api/categories.php';
require __DIR__ . '/api/subcategories.php';
require __DIR__ . '/api/cart.php';
require __DIR__ . '/api/orders.php';
require __DIR__ . '/api/admin.php';
