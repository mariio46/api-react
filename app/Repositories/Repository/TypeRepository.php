<?php

namespace App\Repositories\Repository;

use App\Models\Type;
use App\Repositories\Interfaces\TypeRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TypeRepository implements TypeRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected Type $type)
    {
        $this->baseQuery = $type->query();
    }

    public function getAllTypes()
    {
        return $this->baseQuery
            ->withCount(['products'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function storeType(array $data): Model|static
    {
        $type = $this->type->create([
            'name' => $name = $data['name'],
            'slug' => str($name)->lower()->slug() . '-' . mt_rand(11111, 99999),
        ]);

        return $type->loadCount(['products']);
    }

    public function getSingleType(string $id): Model|static
    {
        return $this->fetchById($id)->firstOrFail()->load([
            'products' => fn ($product) => $product->with(['type:id,name,slug', 'category:id,name,slug']),
        ]);
    }

    public function updateType(array $data, string $id): Model|static
    {
        $type = $this->fetchById($id)->firstOrFail();

        $type->update([
            'name' => $name = $data['name'],
            'slug' => $type->name != $name ? str($name)->lower()->slug() . '-' . mt_rand(11111, 99999) : $type->slug,
        ]);

        return $type->load([
            'products' => fn ($product) => $product->with(['type:id,name,slug', 'category:id,name,slug']),
        ]);
    }

    public function deleteType(string $id): string
    {
        $type = $this->fetchById(id: $id)->firstOrFail();

        $typeTemporaryName = $type->name;

        $type->delete();

        return $typeTemporaryName;
    }

    protected function fetchById(string $id): Builder
    {
        return $this->baseQuery->where('id', $id);
    }
}
