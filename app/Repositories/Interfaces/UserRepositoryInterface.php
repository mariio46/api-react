<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function getAllUsers(int $current_user_id): mixed;

    public function getSingleUser(string $username): Model|static;

    public function storeUser(array $data): Model|static;

    public function updateUser(array $data, string $username): Model|static;

    public function deleteUser(string $username): string;
}
