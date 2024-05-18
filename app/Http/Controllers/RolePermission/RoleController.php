<?php

namespace App\Http\Controllers\RolePermission;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\RoleRequest;
use App\Http\Resources\RolePermission\RoleIndexResource;
use App\Http\Resources\RolePermission\RoleShowResource;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function __construct(protected RoleRepositoryInterface $roleRepositoryInterface)
    {
        //
    }

    public function index(): JsonResponse
    {
        $roles = $this->roleRepositoryInterface->getAllRoleWithCountUserAndPermission();

        return ApiResponse::success(
            data: ['roles' => RoleIndexResource::collection($roles)]
        );
    }

    public function store(RoleRequest $request): JsonResponse
    {
        $role = $this->roleRepositoryInterface->storeRole($request->only(['name', 'permissions']));

        return ApiResponse::created(
            data: ['role' => new RoleIndexResource($role)]
        );
    }

    public function show(string $role_id): JsonResponse
    {
        $role = $this->roleRepositoryInterface->getSingleRoleWithUserAndPermission(role_id: $role_id);

        return ApiResponse::success(
            data: ['role' => new RoleShowResource($role)]
        );
    }

    public function update(RoleRequest $request, string $role_id): JsonResponse
    {
        $role = $this->roleRepositoryInterface->updateRole(data: $request->only(['name', 'permissions']), role_id: $role_id);

        return ApiResponse::success(
            data: ['role' => new RoleShowResource($role)],
        );
    }

    public function delete(string $role_id): JsonResponse
    {
        $roleTemporaryName = $this->roleRepositoryInterface->deleteRole(role_id: $role_id);

        return ApiResponse::success(
            data: "Role with name {$roleTemporaryName} has been deleted successfully."
        );
    }
}
