<?php

namespace App\Http\Controllers\Product;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductBaseResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(protected ProductRepositoryInterface $productRepositoryInterface)
    {
        //
    }

    public function index(): JsonResponse
    {
        $products = $this->productRepositoryInterface->getAllProducts();

        return ApiResponse::success(
            data: ['products' => ProductBaseResource::collection($products)]
        );
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productRepositoryInterface->storeProduct(data: $request->only(['name', 'description', 'price', 'category']));

        return ApiResponse::created(
            data: ['product' => new ProductBaseResource($product)]
        );
    }

    public function show(string $id): JsonResponse
    {
        $product = $this->productRepositoryInterface->getSingleProduct(id: $id);

        return ApiResponse::success(
            data: ['product' => new ProductBaseResource($product)]
        );
    }

    public function update(ProductRequest $request, string $id): JsonResponse
    {
        $product = $this->productRepositoryInterface->updateProduct(data: $request->only(['name', 'description', 'price', 'category']), id: $id);

        return ApiResponse::success(
            data: ['product' => new ProductBaseResource($product)]
        );
    }

    public function delete(string $id): JsonResponse
    {
        $productTemporaryName = $this->productRepositoryInterface->deleteProduct(id: $id);

        return ApiResponse::success(
            data: "Product with name {$productTemporaryName} has been deleted successfully."
        );
    }
}
