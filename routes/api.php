<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/set-countries', [IndexController::class, 'index']);

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('{uuid}', [CategoryController::class, 'show']);
    Route::put('{uuid}', [CategoryController::class, 'update']);
    Route::delete('{uuid}', [CategoryController::class, 'destroy']);
});

Route::prefix('manufacturers')->group(function() {
    Route::get('/', [ManufactureController::class, 'index']);
    Route::post('/', [ManufactureController::class, 'store']);
    Route::get('{uuid}', [ManufactureController::class, 'show']);
    Route::put('{uuid}', [ManufactureController::class, 'update']);
    Route::delete('{uuid}', [ManufactureController::class, 'destroy']);
});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('{uuid}', [ProductController::class, 'show']);
    Route::put('{uuid}', [ProductController::class, 'update']);
    Route::delete('{uuid}', [ProductController::class, 'destroy']);
});


Route::prefix('service')->group(function() {
    Route::get('/', [MaintainController::class, 'index']);
    Route::post('/', [MaintainController::class, 'store']);
    Route::get('{slug}', [MaintainController::class, 'show']);
    Route::put('{slug}', [MaintainController::class, 'update']);
    Route::delete('{slug}', [MaintainController::class, 'destroy']);
});