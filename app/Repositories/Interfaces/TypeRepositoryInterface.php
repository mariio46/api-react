<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface TypeRepositoryInterface
{
    public function getAllTypes();

    public function storeType(array $data): Model|static;

    public function getSingleType(string $id): Model|static;

    public function updateType(array $data, string $id): Model|static;

    public function deleteType(string $id): string;
}
