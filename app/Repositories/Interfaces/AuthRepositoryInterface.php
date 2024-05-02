<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function register(array $data): void;

    public function login(array $data): array;

    public function updateAccount(array $data, User $user): void;

    public function updatePassword(array $data, User $user): void;

    public function deleteAccount(User $user): void;
}
