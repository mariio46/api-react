<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface AuthRepositoryInterface
{
    public function register(array $data): void;

    public function login(array $data): array;

    public function updateAccount(array $data, User $user): Model|static;

    public function updatePassword(array $data, User $user): void;

    public function deleteAccount(User $user): void;
}
