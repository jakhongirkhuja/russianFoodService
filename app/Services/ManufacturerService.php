<?php

namespace App\Services;

use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;

class ManufacturerService
{
    // Create Manufacturer
    public function create(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->validated());
        return $manufacturer;
    }

    // Get Manufacturer by UUID
    public function getByUuid($uuid)
    {
        return Manufacturer::where('uuid', $uuid)->firstOrFail();
    }

    // Update Manufacturer
    public function update(StoreManufacturerRequest $request, $uuid)
    {
       
        $manufacturer = $this->getByUuid($uuid);
        $manufacturer->update($request->validated());
        return $manufacturer;
    }

    // Delete Manufacturer
    public function delete($uuid)
    {
        $manufacturer = $this->getByUuid($uuid);
        $manufacturer->delete();
        return $manufacturer;
    }

    // Get All Manufacturers
    public function getAll()
    {
        return Manufacturer::all();
    }
}