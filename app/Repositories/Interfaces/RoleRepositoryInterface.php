<?php

namespace App\Repositories\Interfaces;

use Spatie\Permission\Contracts\Role as RoleContracts;

interface RoleRepositoryInterface
{
    public function getAllRoleWithCountUserAndPermission();

    public function storeRole(array $data): RoleContracts;

    public function getSingleRoleWithUserAndPermission(string $role_id);

    public function updateRole(array $data, string $role_id): RoleContracts;

    public function deleteRole(string $role_id): string;
}
