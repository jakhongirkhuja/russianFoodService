<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufactureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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
