<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\AuthController;

/*tidak perlu login*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('products/search', [ProductController::class, 'search']);


/*Harus login*/

Route::middleware('auth:api')->group(function () {

    //Bisa diakses semua user login
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('inventory/value', [InventoryController::class, 'totalValue']);


    //ADMIN ONLY
    Route::middleware('admin')->group(function () {

        // Products
        Route::post('products', [ProductController::class, 'store']);
        Route::put('products/{product}', [ProductController::class, 'update']);
        Route::delete('products/{product}', [ProductController::class, 'destroy']);
        Route::post('products/update-stock', [ProductController::class, 'updateStock']);
        //diskon
        Route::post('products/set-disc', [ProductController::class, 'setDiscount']);
        Route::post('products/remove-disc', [ProductController::class, 'removeDiscount']);

        // Categories
        Route::post('categories', [CategoryController::class, 'store']);
    });
});