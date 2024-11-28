<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        
        $categories = $this->categoryService->getAll();
        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->getByUuid($id);
        return response()->json($category);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
       
        $category = $this->categoryService->update($id, $request->validated());
        return response()->json($category);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->json(null, 204);
    }
}
