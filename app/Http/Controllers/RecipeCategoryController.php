<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRecipeCategoryRequest;
use App\Services\RecipeCategoryService;
use Illuminate\Http\Response;

class RecipeCategoryController extends Controller
{
    protected $recipeCategoryService;

    public function __construct(RecipeCategoryService $recipeCategoryService)
    {
        $this->recipeCategoryService = $recipeCategoryService;
    }

    // Create a new recipe category
    public function store(StoreUpdateRecipeCategoryRequest $request)
    {
        $data = $request->validated();

        $category = $this->recipeCategoryService->create($data);

        return response()->json($category, Response::HTTP_CREATED);
    }

    // Get all recipe categories
    public function index()
    {
        $categories = $this->recipeCategoryService->getAll();

        return response()->json($categories, Response::HTTP_OK);
    }

    // Get a single recipe category by UUID
    public function show($uuid)
    {
        $category = $this->recipeCategoryService->getByUuid($uuid);

        return response()->json($category, Response::HTTP_OK);
    }

    // Update an existing recipe category by UUID
    public function update(StoreUpdateRecipeCategoryRequest $request, $uuid)
    {
        $data = $request->validated();

        $category = $this->recipeCategoryService->update($uuid, $data);

        return response()->json($category, Response::HTTP_OK);
    }

    // Delete a recipe category by UUID
    public function destroy($uuid)
    {
        $category = $this->recipeCategoryService->delete($uuid);

        return response()->json($category, Response::HTTP_NO_CONTENT);
    }
}
