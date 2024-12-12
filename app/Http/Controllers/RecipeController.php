<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use App\Services\RecipeService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * Display a listing of the recipes.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json(['data' => $recipes], 200);
    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = $this->recipeService->store($request->validated());
        return response()->json(['message' => 'Recipe created successfully', 'data' => $recipe], 201);
    }

    /**
     * Display the specified recipe.
     */
    public function show(Recipe $recipe)
    {
        return response()->json(['data' => $recipe], 200);
    }

    /**
     * Update the specified recipe in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $updatedRecipe = $this->recipeService->update($recipe, $request->validated());
        return response()->json(['message' => 'Recipe updated successfully', 'data' => $updatedRecipe], 200);
    }

    /**
     * Remove the specified recipe from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // Delete the image if it exists
        if ($recipe->image && file_exists(public_path($recipe->image))) {
            unlink(public_path($recipe->image));
        }

        $recipe->delete();

        return response()->json(['message' => 'Recipe deleted successfully'], 200);
    }
}
