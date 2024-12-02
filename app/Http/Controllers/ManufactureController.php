<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManufacturerRequest;
use App\Services\ManufacturerService;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    protected $manufacturerService;

    public function __construct(ManufacturerService $manufacturerService)
    {
        $this->manufacturerService = $manufacturerService;
    }

    // Create Manufacturer
    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = $this->manufacturerService->create($request);
        return response()->json($manufacturer, 201);
    }

    // Get All Manufacturers
    public function index()
    {
        $manufacturers = $this->manufacturerService->getAll();
        return response()->json($manufacturers);
    }

    // Get Manufacturer by UUID
    public function show($uuid)
    {
        $manufacturer = $this->manufacturerService->getByUuid($uuid);
        return response()->json($manufacturer);
    }

    // Update Manufacturer
    public function update(StoreManufacturerRequest $request, $uuid)
    {
        
        $manufacturer = $this->manufacturerService->update($request, $uuid);
        return response()->json($manufacturer);
    }

    // Delete Manufacturer
    public function destroy($uuid)
    {
        $manufacturer = $this->manufacturerService->delete($uuid);
        return response()->json(null, 204);
    }
}
