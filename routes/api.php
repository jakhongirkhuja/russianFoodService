<?php

use App\Http\Controllers\Api\IndexController as ApiIndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('/set-regions', [RegionController::class, 'index']);
Route::get('/list-countries', [IndexController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); 

Route::prefix('v1')->group(function(){
    Route::prefix('front')->group(function(){
        Route::get('categories', [ApiIndexController::class, 'categories']);
        Route::get('regions-map', [ApiIndexController::class, 'regionMap']);
        Route::get('countries', [ApiIndexController::class, 'countries']);
        
        Route::get('products', [ApiIndexController::class, 'products']);
        Route::get('products/{slug}', [ApiIndexController::class, 'productIndex']);

        Route::get('services', [ApiIndexController::class, 'services']);
        Route::get('services/{slug}', [ApiIndexController::class, 'serviceIndex']);

        Route::get('faqs', [ApiIndexController::class, 'faqs']);

        
        Route::get('events', [ApiIndexController::class, 'events']);
        Route::get('events/{slug}', [ApiIndexController::class, 'eventsIndex']);
        Route::get('events/{slug}/similars', [ApiIndexController::class, 'eventsSimilar']);




        Route::get('news', [ApiIndexController::class, 'news']);
        Route::get('news/{slug}', [ApiIndexController::class, 'newsIndex']);
        Route::get('news/{slug}/similars', [ApiIndexController::class, 'newsSimilar']);

        Route::post('form/submit',[ApiIndexController::class,'formSubmit']);
    });

});

Route::get('/list-countries', [IndexController::class, 'index']);



Route::prefix('cabinet')->middleware('auth:sanctum')->group(function() {
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('{uuid}', [CategoryController::class, 'show']);
        Route::post('{uuid}', [CategoryController::class, 'update']);
        Route::delete('{uuid}', [CategoryController::class, 'destroy']);
    });
    
    Route::prefix('manufacturers')->group(function() {
        Route::get('/', [ManufactureController::class, 'index']);
        Route::post('/', [ManufactureController::class, 'store']);
        Route::get('{uuid}', [ManufactureController::class, 'show']);
        Route::post('{uuid}', [ManufactureController::class, 'update']);
        Route::delete('{uuid}', [ManufactureController::class, 'destroy']);
    });
    
    Route::prefix('products')->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('{uuid}', [ProductController::class, 'show']);
        Route::post('{uuid}', [ProductController::class, 'update']);
        Route::delete('{uuid}', [ProductController::class, 'destroy']);
    });
    
    
    Route::prefix('service')->group(function() {
        Route::get('/', [MaintainController::class, 'index']);
        Route::post('/', [MaintainController::class, 'store']);
        Route::get('{uuid}', [MaintainController::class, 'show']);
        Route::post('{uuid}', [MaintainController::class, 'update']);
        Route::delete('{uuid}', [MaintainController::class, 'destroy']);
    });
    
    Route::prefix('news')->group(function() {
        Route::get('', [NewsController::class, 'index']);
        Route::post('', [NewsController::class, 'store']);
        Route::get('{uuid}', [NewsController::class, 'show']);
        Route::post('{uuid}', [NewsController::class, 'update']);
        Route::delete('{uuid}', [NewsController::class, 'destroy']);
    });
    
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index']);           
        Route::post('/', [TagController::class, 'store']);         
        Route::get('/{id}', [TagController::class, 'show']);       
        Route::post('/{id}', [TagController::class, 'update']);    
        Route::delete('/{id}', [TagController::class, 'destroy']); 
    });
    
    Route::prefix('questions')->group(function () {
        Route::get('/', [QuestionController::class, 'index']);           
        Route::post('/', [QuestionController::class, 'store']);         
        Route::get('/{uuid}', [QuestionController::class, 'show']);       
        Route::post('/{uuid}', [QuestionController::class, 'update']);    
        Route::delete('/{uuid}', [QuestionController::class, 'destroy']); 
    });

    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index']);           
        Route::post('/', [EventController::class, 'store']);         
        Route::get('/{uuid}', [EventController::class, 'show']);       
        Route::post('/{uuid}', [EventController::class, 'update']);    
        Route::delete('/{uuid}', [EventController::class, 'destroy']); 
    });
});



