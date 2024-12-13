<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostChefsRequest;
use App\Http\Requests\UpdateChefsRequest;
use App\Services\ChefService;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    protected $chefService;

    public function __construct(ChefService $chefService)
    {
        $this->chefService = $chefService;
    }

    public function index()
    {
        
        $categories = $this->chefService->getAll();
        return response()->json($categories);
    }

    public function store(PostChefsRequest $request)
    {
        $category = $this->chefService->create($request->validated());
        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->chefService->getByUuid($id);
        return response()->json($category);
    }

    public function update(UpdateChefsRequest $request, $id)
    {
       
        $category = $this->chefService->update($id, $request->validated());
        return response()->json($category);
    }

    public function destroy($id)
    {
        $this->chefService->delete($id);
        return response()->json(null, 204);
    }
}
