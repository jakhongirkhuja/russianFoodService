<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/list-countries', [IndexController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); 

Route::prefix('categories')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('{uuid}', [CategoryController::class, 'show']);
    Route::post('{uuid}', [CategoryController::class, 'update']);
    Route::delete('{uuid}', [CategoryController::class, 'destroy']);
});

Route::prefix('manufacturers')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [ManufactureController::class, 'index']);
    Route::post('/', [ManufactureController::class, 'store']);
    Route::get('{uuid}', [ManufactureController::class, 'show']);
    Route::post('{uuid}', [ManufactureController::class, 'update']);
    Route::delete('{uuid}', [ManufactureController::class, 'destroy']);
});

Route::prefix('products')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('{uuid}', [ProductController::class, 'show']);
    Route::post('{uuid}', [ProductController::class, 'update']);
    Route::delete('{uuid}', [ProductController::class, 'destroy']);
});


Route::prefix('service')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [MaintainController::class, 'index']);
    Route::post('/', [MaintainController::class, 'store']);
    Route::get('{slug}', [MaintainController::class, 'show']);
    Route::post('{slug}', [MaintainController::class, 'update']);
    Route::delete('{slug}', [MaintainController::class, 'destroy']);
});

Route::prefix('news')->middleware('auth:sanctum')->group(function() {
    Route::get('', [NewsController::class, 'index']);
    Route::post('', [NewsController::class, 'store']);
    Route::get('{uuid}', [NewsController::class, 'show']);
    Route::post('{uuid}', [NewsController::class, 'update']);
    Route::delete('{uuid}', [NewsController::class, 'destroy']);
});

Route::prefix('tags')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TagController::class, 'index']);           
    Route::post('/', [TagController::class, 'store']);         
    Route::get('/{tag}', [TagController::class, 'show']);       
    Route::post('/{tag}', [TagController::class, 'update']);    
    Route::delete('/{tag}', [TagController::class, 'destroy']); 
});

