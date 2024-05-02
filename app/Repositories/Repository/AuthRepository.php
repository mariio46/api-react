<?php

namespace App\Repositories\Repository;

use App\Http\Resources\Auth\AuthenticatedUserResource;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Error;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data): void
    {
        $user = new User([
            'name' => $name = $data['name'],
            'username' => generateUsername(value: $name),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->saveOrFail();

        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        } else {
            throw new Error(
                message: 'Failed when creating user.',
                code: 500,
            );
        }
    }

    public function login(array $data): array
    {
        $requested_user = User::query()->where('email', $data['email'])->first();

        if (! $requested_user || ! Hash::check($data['password'], $requested_user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $requested_user->tokens()->delete();

        $token = $requested_user->createToken(name: "login-api-token-{$requested_user->username}", expiresAt: now()->addDay());

        return [
            'user' => new AuthenticatedUserResource($requested_user),
            'access_token' => [
                'expires_at' => $token->accessToken->expires_at,
                'token' => $token->plainTextToken,
            ],
        ];
    }

    public function updateAccount(array $data, User $user): void
    {
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'last_updated_account' => now(),
        ]);

        $user->saveOrFail();

        if (! $user->wasChanged(['name', 'email', 'last_updated_account'])) {
            throw new Error(
                message: 'Failed when updating account.',
                code: 500,
            );
        }
    }

    public function updatePassword(array $data, User $user): void
    {
        $user->fill([
            'password' => Hash::make($data['password']),
            'last_updated_password' => now(),
        ]);

        $user->saveOrFail();

        if ($user->wasChanged('password')) {
            $user->tokens()->delete();
        } else {
            throw new Error(
                message: 'Failed when updating password.',
                code: 500,
            );
        }
    }

    public function deleteAccount(User $user): void
    {
        $user_was_deleted = $user->delete();

        if ($user_was_deleted == true || $user_was_deleted != null) {
            $user->tokens()->delete();
        } else {
            throw new Error(
                message: 'Failed when deleting user.',
                code: 500,
            );
        }
    }
}
