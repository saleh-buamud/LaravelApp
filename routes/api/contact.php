<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

Route::post('/contact', [ContactController::class, 'send'])->middleware('throttle:10,1');
