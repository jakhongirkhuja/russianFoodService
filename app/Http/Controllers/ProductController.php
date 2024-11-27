<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Create Product
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request);
        return response()->json($product, 201);
    }

    // Get All Products
    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($products);
    }

    // Get Product by UUID
    public function show($uuid)
    {
        $product = $this->productService->getByUuid($uuid);
        return response()->json($product);
    }

    // Update Product
    public function update(UpdateProductRequest $request, $uuid)
    {
        $product = $this->productService->update($request, $uuid);
        return response()->json($product);
    }

    // Delete Product
    public function destroy($uuid)
    {
        $product = $this->productService->delete($uuid);
        return response()->json(null, 204);
    }
}
