<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeDietTypeRequest;
use App\Services\RecipeDietTypeService;
use Illuminate\Http\Request;

class RecipeDietTypeController extends Controller
{
    protected $recipeDietTypeService;

    public function __construct(RecipeDietTypeService $recipeDietTypeService)
    {
        $this->recipeDietTypeService = $recipeDietTypeService;
    }

    public function index()
    {
        $dietTypes = $this->recipeDietTypeService->getAll();
        return response()->json($dietTypes);
    }

    public function store(StoreRecipeDietTypeRequest $request)
    {
        $validated = $request->validated();
        $dietType = $this->recipeDietTypeService->create($validated);

        return response()->json($dietType, 201);
    }

    public function show($uuid)
    {
        $dietType = $this->recipeDietTypeService->getByUuid($uuid);
        return response()->json($dietType);
    }

    public function update(StoreRecipeDietTypeRequest $request, $uuid)
    {
        $validated = $request->validated();
        $dietType = $this->recipeDietTypeService->update($uuid, $validated);

        return response()->json($dietType);
    }

    public function destroy($uuid)
    {
        $this->recipeDietTypeService->delete($uuid);

        return response()->json(['message' => 'Diet type deleted successfully']);
    }
}
