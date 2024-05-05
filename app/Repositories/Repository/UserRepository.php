<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Error;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function baseQuery(): Builder
    {
        return User::query();
    }

    public function getAllUsers(int $current_user_id)
    {
        return $this->baseQuery()
            ->where('id', '!=', $current_user_id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getAllPaginateUsers(?string $search = null): LengthAwarePaginator
    {
        return $this->baseQuery()
            ->where('id', '!=', request()->user()->id)
            ->when($search != null ?  $search : null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereAny(
                        ['name', 'username', 'email'],
                        'REGEXP',
                        $search
                    );
                });
            })
            ->select('id', 'name', 'email', 'username', 'email_verified_at', 'created_at')
            ->latest()
            ->paginate(10);
    }

    public function getSingleUser(string $username): mixed
    {
        return $this->baseQuery()
            ->where('username', $username)
            ->firstOr(
                callback: fn () => abort(code: 404, message: 'User not found.')
            );
    }

    public function storeNewUser(array $data): void
    {
        $user = new User([
            'name' => $name = $data['name'],
            'username' => generateUsername(value: $name),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->saveOrFail();

        if (!$user->wasRecentlyCreated) {
            throw new Error(
                message: 'Failed when creating new user.',
                code: 500,
            );
        }
    }

    public function updateUser(array $data, User $user): mixed
    {
        $user->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'last_updated_account' => now(),
        ]);

        $user->save();

        if (!$user->wasChanged(['name', 'username', 'email', 'last_updated_account'])) {
            throw new Error(
                message: "Failed when updating user with name: {$user->name}.",
                code: 500,
            );
        }

        return $user->username;
    }
}
