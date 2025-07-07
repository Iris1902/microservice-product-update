<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::put('/products-update/{id}', [ProductController::class, 'update']);
Route::get('/products-update/health', [ProductController::class, 'healthCheck']);

