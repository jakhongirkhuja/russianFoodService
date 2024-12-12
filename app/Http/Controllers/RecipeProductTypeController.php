<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeProductTypeRequest;
use App\Services\RecipeProductTypeService;
use Illuminate\Http\Request;

class RecipeProductTypeController extends Controller
{
    protected $recipeProductTypeService;

    public function __construct(RecipeProductTypeService $recipeProductTypeService)
    {
        $this->recipeProductTypeService = $recipeProductTypeService;
    }

    // Get all product types
    public function index()
    {
        $productTypes = $this->recipeProductTypeService->getAll();
        return response()->json($productTypes);
    }

    // Create a new product type
    public function store(StoreRecipeProductTypeRequest $request)
    {
        $validated = $request->validated();
        $productType = $this->recipeProductTypeService->create($validated);

        return response()->json($productType, 201);
    }

    // Get a single product type by UUID
    public function show($uuid)
    {
        $productType = $this->recipeProductTypeService->getByUuid($uuid);
        return response()->json($productType);
    }

    // Update a product type by UUID
    public function update(StoreRecipeProductTypeRequest $request, $uuid)
    {
        $validated = $request->validated();
        $productType = $this->recipeProductTypeService->update($uuid, $validated);

        return response()->json($productType);
    }

    // Delete a product type by UUID
    public function destroy($uuid)
    {
        $this->recipeProductTypeService->delete($uuid);

        return response()->json(['message' => 'Product type deleted successfully'],204);
    }
}
