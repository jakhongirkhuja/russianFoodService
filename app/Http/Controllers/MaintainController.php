<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintainRequest;
use App\Http\Requests\UpdateMaintainRequest;
use App\Models\Maintain;
use App\Services\MaintainService;
use Illuminate\Http\Request;

class MaintainController extends Controller
{
    private $maintainService;

    public function __construct(MaintainService $maintainService)
    {
        $this->maintainService = $maintainService;
    }
    public function index()
    {
        $products = $this->maintainService->getAll();
        return response()->json($products);
    }
    public function show($slug)
    {
        $product = $this->maintainService->getBySlug($slug);
        return response()->json($product);
    }
    public function store(StoreMaintainRequest $request)
    {
        $maintain = $this->maintainService->createMaintain($request->validated());

        return response()->json($maintain, 201);
    }

    public function update(UpdateMaintainRequest $request,  $slug)
    {
        $maintain = $this->maintainService->getBySlug($slug);
       
        $updatedMaintain = $this->maintainService->updateMaintain($maintain, $request->validated());

        return response()->json($updatedMaintain, 200);
    }

    public function destroy($slug)
    {
        $this->maintainService->deleteMaintain($slug);

        return response()->json(['message' => 'Maintain record deleted successfully'], 200);
    }
}