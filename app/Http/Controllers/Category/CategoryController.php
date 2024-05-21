<?php

namespace App\Http\Controllers\Category;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Category\CategoryShowResource;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        //
    }

    public function index()
    {
        $categories = $this->categoryRepositoryInterface->getAllCategories();

        return ApiResponse::success(
            data: ['categories' => CategoryIndexResource::collection($categories)],
        );
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepositoryInterface->storeCategory($request->only(['name']));

        return ApiResponse::created(
            data: ['category' => new CategoryShowResource($category)],
        );
    }

    public function show(string $id)
    {
        $category = $this->categoryRepositoryInterface->getSingleCategory(id: $id);

        return ApiResponse::success(
            data: ['category' => new CategoryShowResource($category)],
        );
    }

    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->categoryRepositoryInterface->updateCategory($request->only(['name']), $id);

        return ApiResponse::success(
            data: ['category' => new CategoryShowResource($category)],
        );
    }

    public function delete(string $id)
    {
        $categoryTemporaryName = $this->categoryRepositoryInterface->deleteCategory(id: $id);

        return ApiResponse::success(
            data: "Category with name {$categoryTemporaryName} has been deleted successfully."
        );
    }
}
