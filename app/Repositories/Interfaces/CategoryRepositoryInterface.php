<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function storeCategory(array $data): Model|static;

    public function getSingleCategory(string $id): Model|static;

    public function updateCategory(array $data, string $id): Model|static;

    public function deleteCategory(string $id): string;
}
