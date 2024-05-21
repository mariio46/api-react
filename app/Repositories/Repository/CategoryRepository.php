<?php

namespace App\Repositories\Repository;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected Category $category)
    {
        $this->baseQuery = $category->query();
    }

    public function getAllCategories()
    {
        return $this->baseQuery
            ->withCount(['products'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function storeCategory(array $data): Model|static
    {
        $category = Category::create([
            'name' => $name = $data['name'],
            'slug' => str($name)->lower()->slug() . '-' . mt_rand(11111, 99999),
        ]);

        return $category;
    }

    public function getSingleCategory(string $id): Model|static
    {
        $category = $this->fetchById(id: $id)->firstOrFail()->load(['products:category_id,id,name,price']);

        return $category;
    }

    public function updateCategory(array $data, string $id): Model|static
    {
        $category = $this->fetchById(id: $id)->firstOrFail();

        $category->update([
            'name' => $name = $data['name'],
            'slug' => $category->name != $name ? str($name)->lower()->slug() . '-' . mt_rand(11111, 99999) : $category->slug,
        ]);

        return $category->load(['products:category_id,id,name,price']);
    }

    public function deleteCategory(string $id): string
    {
        $category = $this->fetchById(id: $id)->firstOrFail();

        $categoryTemporaryName = $category->name;

        $category->delete();

        return $categoryTemporaryName;
    }

    protected function fetchById(string $id): Builder
    {
        return $this->baseQuery->where('id', $id);
    }
}
