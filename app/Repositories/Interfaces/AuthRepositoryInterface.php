<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

interface AuthRepositoryInterface
{
    public function register(RegisterRequest $request): void;

    public function login(LoginRequest $request): string;
}
