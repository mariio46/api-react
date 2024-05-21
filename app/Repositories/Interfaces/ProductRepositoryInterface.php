<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function storeProduct(array $data): Model|static;

    public function getSingleProduct(string $id): Model|static;

    public function updateProduct(array $data, string $id): Model|static;

    public function deleteProduct(string $id): string;
}
