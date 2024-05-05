<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function baseQuery(): Builder;

    public function getAllUsers(int $current_user_id);

    public function getAllPaginateUsers(?string $search = null): LengthAwarePaginator;

    public function getSingleUser(string $username): mixed;

    public function storeNewUser(array $data): void;

    public function updateUser(array $data, User $user): mixed;
}
