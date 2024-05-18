<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected User $user)
    {
        $this->baseQuery = $user->query();
    }

    public function getAllUsers(int $current_user_id): mixed
    {
        return $this->baseQuery
            ->where('id', '!=', $current_user_id)
            ->with(['roles'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function storeUser(array $data): Model|static
    {
        $user = $this->user->create([
            'name' => $name = $data['name'],
            'username' => generateUsername(value: $name),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('member');

        return $user;
    }

    public function getSingleUser(string $username): Model|static
    {
        return $this->fetchByUsername($username)->firstOrFail()->load(['roles']);
    }

    public function updateUser(array $data, string $username): Model|static
    {
        $user = $this->fetchByUsername($username)->firstOrFail()->load(['roles']);

        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'last_updated_account' => now(),
        ]);

        return $user;
    }

    public function deleteUser(string $username): string
    {
        $user = $this->fetchByUsername($username)->firstOrFail();

        $temporaryUserName = $user->name;

        $user->delete();

        return $temporaryUserName;
    }

    protected function fetchByUsername(string $useranme): Builder
    {
        return $this->baseQuery->where('username', $useranme);
    }
}
