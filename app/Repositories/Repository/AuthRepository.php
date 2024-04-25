<?php

namespace App\Repositories\Repository;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(RegisterRequest $request): void
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));
    }

    public function login(LoginRequest $request): string
    {
        if (!Auth::attempt($request->only(['email', 'password']), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->user()->tokens()->delete();

        $token = $request->user()->createToken('auth-api-token')->plainTextToken;

        return $token;
    }
}
