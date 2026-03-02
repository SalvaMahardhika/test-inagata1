<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InventoryController;

Route::get('products/search', [ProductController::class, 'search']);
Route::post('products/update-stock', [ProductController::class, 'updateStock']);

Route::apiResource('products', ProductController::class)->except(['create','edit']);

Route::apiResource('categories', CategoryController::class)->only(['index','store']);

Route::get('inventory/value', [InventoryController::class, 'totalValue']);