<?php

namespace App\Repositories\Repository;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Contracts\Permission as PermissionContracts;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $baseQuery;

    public function __construct(protected Permission $permission)
    {
        $this->baseQuery = $permission->query();
    }

    public function getAllPermissions()
    {
        return $this->baseQuery->withCount('roles')->latest()->get();
    }

    public function storePermission(array $data): PermissionContracts
    {
        $permission = $this->permission->create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        return $permission;
    }

    public function getSinglePermission(string $permission_id): PermissionContracts
    {
        $permission = $this->fetchById($permission_id)->with(['roles'])->first();

        $this->checkIfPermissionIsNotExists($permission);

        return $permission;
    }

    public function updatePermission(array $data, string $permission_id): PermissionContracts
    {
        $permission = $this->fetchById($permission_id)->first();

        $this->checkIfPermissionIsNotExists($permission);

        $permission->update([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        return $permission;
    }

    public function deletePermission(string $permission_id): string
    {
        $permission = $this->fetchById($permission_id)->first();

        $this->checkIfPermissionIsNotExists($permission);

        $temporaryPermissionName = $permission->name;

        $permission->delete();

        return $temporaryPermissionName;
    }

    protected function fetchById(string $id): Builder
    {
        return $this->baseQuery->where('id', $id);
    }

    protected function checkIfPermissionIsNotExists($permission)
    {
        if (! $permission) {
            throw new NotFoundHttpException('The permission that you looking for is not exists!');
        }
    }
}
