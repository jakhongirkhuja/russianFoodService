<?php

use App\Http\Controllers\Api\IndexController as ApiIndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MaintainController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecipeCategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeDietTypeController;
use App\Http\Controllers\RecipeMealTypeController;
use App\Http\Controllers\RecipeProductTypeController;
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
        Route::get('recipes-categories', [ApiIndexController::class, 'recipeCategories']);
        Route::get('recipes-subCategories', [ApiIndexController::class, 'recipeSubCategories']);
        Route::get('recipes', [ApiIndexController::class, 'recipes']);
        Route::get('recipes/{slug}', [ApiIndexController::class, 'recipeIndex']);
        Route::get('recipes/{slug}/similars', [ApiIndexController::class, 'recipeIndexSimilars']);
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


        Route::get('chefs', [ApiIndexController::class, 'chefs']);
        Route::get('chefsIndex/{uuid}', [ApiIndexController::class, 'chefIndex']);
        Route::get('chefs/{uuid}', [ApiIndexController::class, 'chefsRecipe']);
        
        Route::get('search', [ApiIndexController::class, 'searchItems']);

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


    Route::prefix('recipe-categories')->group(function () {
        Route::get('/', [RecipeCategoryController::class, 'index']); // Get all categories
        Route::post('/', [RecipeCategoryController::class, 'store']); // Create new category
        Route::get('{uuid}', [RecipeCategoryController::class, 'show']); // Get single category by UUID
        Route::post('{uuid}', [RecipeCategoryController::class, 'update']); // Update category
        Route::delete('{uuid}', [RecipeCategoryController::class, 'destroy']); // Delete category
    });


    
    Route::prefix('recipe-meal-types')->group(function () {
        Route::get('/', [RecipeMealTypeController::class, 'index']);
        Route::post('/', [RecipeMealTypeController::class, 'store']);
        Route::get('/{uuid}', [RecipeMealTypeController::class, 'show']);
        Route::post('/{uuid}', [RecipeMealTypeController::class, 'update']);
        Route::delete('/{uuid}', [RecipeMealTypeController::class, 'destroy']);
    });

    Route::prefix('recipe-product-types')->group(function () {
        Route::get('/', [RecipeProductTypeController::class, 'index']);
        Route::post('/', [RecipeProductTypeController::class, 'store']);
        Route::get('/{uuid}', [RecipeProductTypeController::class, 'show']);
        Route::post('/{uuid}', [RecipeProductTypeController::class, 'update']);
        Route::delete('/{uuid}', [RecipeProductTypeController::class, 'destroy']);
    });

    Route::prefix('recipe-diet-types')->group(function () {
        Route::get('/', [RecipeDietTypeController::class, 'index']);
        Route::post('/', [RecipeDietTypeController::class, 'store']);
        Route::get('/{uuid}', [RecipeDietTypeController::class, 'show']);
        Route::post('/{uuid}', [RecipeDietTypeController::class, 'update']);
        Route::delete('/{uuid}', [RecipeDietTypeController::class, 'destroy']);
    });

    Route::prefix('recipes')->group(function () {
        Route::get('/', [RecipeController::class, 'index']);
        Route::post('/', [RecipeController::class, 'store']);
        Route::get('/{uuid}', [RecipeController::class, 'show']);
        Route::post('/{uuid}', [RecipeController::class, 'update']);
        Route::delete('/{uuid}', [RecipeController::class, 'destroy']);
    });

    Route::prefix('chefs')->group(function () {
        Route::get('/', [ChefController::class, 'index']);
        Route::post('/', [ChefController::class, 'store']);
        Route::get('/{uuid}', [ChefController::class, 'show']);
        Route::post('/{uuid}', [ChefController::class, 'update']);
        Route::delete('/{uuid}', [ChefController::class, 'destroy']);
    });
});



