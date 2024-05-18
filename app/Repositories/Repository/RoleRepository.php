<?php

namespace App\Repositories\Repository;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Contracts\Role as RoleContracts;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleRepository implements RoleRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected Role $role)
    {
        $this->baseQuery = $role->query();
    }

    public function getAllRoleWithCountUserAndPermission()
    {
        return $this->baseQuery
            ->where('name', '!=', 'superadmin')
            ->withCount(['permissions'])
            ->orderBy('id', 'asc')
            ->get();
    }

    public function storeRole(array $data): RoleContracts
    {
        $role = $this->role->create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        if (! empty($data['permissions'])) {
            $role->givePermissionTo($data['permissions']);
        }

        return $role;
    }

    public function getSingleRoleWithUserAndPermission(string $role_id)
    {
        $role = $this->fetchById(id: $role_id)->first();

        $this->checkIfRoleIsNotExists($role);

        $this->checkIfRoleIsSuperadmin($role);

        return $role;
    }

    public function updateRole(array $data, string $role_id): RoleContracts
    {
        $role = $this->fetchById(id: $role_id)->first();

        $this->checkIfRoleIsNotExists($role);

        $this->checkIfRoleIsSuperadmin($role);

        $role->update([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        if (! empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return $role;
    }

    public function deleteRole(string $role_id): string
    {
        $role = $this->fetchById(id: $role_id)->first();

        $this->checkIfRoleIsNotExists($role);

        $this->checkIfRoleIsSuperadmin($role);

        $temporaryRoleName = $role->name;

        $role->delete();

        return $temporaryRoleName;
    }

    protected function fetchById(string $id): Builder
    {
        return $this->baseQuery->where('id', $id);
    }

    protected function checkIfRoleIsNotExists($role)
    {
        if (! $role) {
            throw new NotFoundHttpException('No query results for model [Spatie\\Permission\\Models\\Role].');
        }
    }

    protected function checkIfRoleIsSuperadmin(Role $role): void
    {
        if ($role->id == 1 || $role->name == 'superadmin') {
            throw new NotFoundHttpException('No query results for model [Spatie\\Permission\\Models\\Role].');
        }
    }
}
