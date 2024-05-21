<?php

namespace App\Repositories\Repository;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected Product $product)
    {
        $this->baseQuery = $product->query();
    }

    public function getAllProducts()
    {
        return $this->baseQuery
            ->orderBy('id', 'desc')
            ->get();
    }

    public function storeProduct(array $data): Model|static
    {
        $product = $this->product->create([
            'name' => $name = $data['name'],
            'slug' => str($name)->lower()->slug() . '-' . mt_rand(11111, 99999),
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        return $product;
    }

    public function getSingleProduct(string $id): Model|static
    {
        return $this->fetchById($id)->firstOrFail();
    }

    public function updateProduct(array $data, string $id): Model|static
    {
        $product = $this->fetchById($id)->firstOrFail();

        $product->update([
            'name' => $name = $data['name'],
            'slug' => $product->name != $name ? str($name)->lower()->slug() . '-' . mt_rand(11111, 99999) : $product->slug,
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        return $product;
    }

    public function deleteProduct(string $id): string
    {
        $product = $this->fetchById($id)->firstOrFail();

        $productTemporaryName = $product->name;

        $product->delete();

        return $productTemporaryName;
    }

    protected function fetchById(string $id): Builder
    {
        return $this->baseQuery->where('id', $id);
    }
}
