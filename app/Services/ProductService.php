<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductService
{
    // Create Product
    public function create(StoreProductRequest $request)
    {
        
        $product = new Product();
        return $product->saveModel($request->validated());
    }

    // Get Product by UUID
    public function getByUuid($uuid)
    {
       
        return Product::where('uuid', $uuid)->firstOrFail();
    }

    // Update Product
    public function update(UpdateProductRequest $request, $uuid)
    {
        $product = $this->getByUuid($uuid);
        $product->updateModel($request->validated());
        return $product;
    }

    // Delete Product
    public function delete($uuid)
    {
        $product = $this->getByUuid($uuid);
        $product->deleteModel();
        return $product;
    }

    // Get All Products
    public function getAll()
    {
        return Product::with('manufacturer','countryImport','countryMadeIn','category')->get();
    }
}