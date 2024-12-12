<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeMealTypeRequest;
use App\Services\RecipeMealTypeService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecipeMealTypeController extends Controller
{
    protected $recipeMealTypeService;

    public function __construct(RecipeMealTypeService $recipeMealTypeService)
    {
        $this->recipeMealTypeService = $recipeMealTypeService;
    }

    // Store a new meal type
    public function store(StoreRecipeMealTypeRequest $request)
    {
        // The request data is already validated at this point
        $validated = $request->validated();

        // Call the service to create a new meal type
        $mealType = $this->recipeMealTypeService->create($validated);

        return response()->json($mealType, 201);
    }

    // Get all meal types
    public function index()
    {
        $mealTypes = $this->recipeMealTypeService->getAll();
        return response()->json($mealTypes);
    }

    // Get a single meal type by UUID
    public function show($uuid)
    {
        $mealType = $this->recipeMealTypeService->getByUuid($uuid);
        return response()->json($mealType);
    }

    // Update an existing meal type by UUID
    public function update(StoreRecipeMealTypeRequest $request, $uuid)
    {
        // The request data is already validated at this point
        $validated = $request->validated();

        $mealType = $this->recipeMealTypeService->update($uuid, $validated);

        return response()->json($mealType);
    }

    // Delete a meal type by UUID
    public function destroy($uuid)
    {
        $mealType = $this->recipeMealTypeService->delete($uuid);

        return response()->json(['message' => 'Meal type deleted successfully'], 204);
    }
}
