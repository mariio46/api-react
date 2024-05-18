<?php

namespace App\Repositories\Interfaces;

use Spatie\Permission\Contracts\Permission as PermissionContracts;

interface PermissionRepositoryInterface
{
    public function getAllPermissions();

    public function storePermission(array $data): PermissionContracts;

    public function getSinglePermission(string $permission_id): PermissionContracts;

    public function updatePermission(array $data, string $permission_id): PermissionContracts;

    public function deletePermission(string $permission_id): string;
}
