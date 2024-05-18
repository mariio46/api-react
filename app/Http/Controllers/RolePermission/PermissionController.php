<?php

namespace App\Http\Controllers\RolePermission;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermission\PermissionRequest;
use App\Http\Resources\RolePermission\PermissionIndexResource;
use App\Http\Resources\RolePermission\PermissionShowResource;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    public function __construct(protected PermissionRepositoryInterface $permissionRepositoryInterface)
    {
        //
    }

    public function index(): JsonResponse
    {
        $permissions = $this->permissionRepositoryInterface->getAllPermissions();

        return ApiResponse::success(
            data: ['permissions' => PermissionIndexResource::collection($permissions)]
        );
    }

    public function store(PermissionRequest $request): JsonResponse
    {
        $permission = $this->permissionRepositoryInterface->storePermission($request->only(['name']));

        return ApiResponse::created(
            data: ['permission' => new PermissionIndexResource($permission)]
        );
    }

    public function show(string $permission_id)
    {
        $permission = $this->permissionRepositoryInterface->getSinglePermission($permission_id);

        return ApiResponse::success(
            data: ['permission' => new PermissionShowResource($permission)],
        );
    }

    public function update(PermissionRequest $request, string $permission_id): JsonResponse
    {
        $permission = $this->permissionRepositoryInterface->updatePermission(data: $request->only(['name']), permission_id: $permission_id);

        return ApiResponse::success(
            data: ['permission' => new PermissionShowResource($permission)]
        );
    }

    public function delete(string $permission_id): JsonResponse
    {
        $temporaryPermissionName = $this->permissionRepositoryInterface->deletePermission($permission_id);

        return ApiResponse::success(
            data: "Permission with name {$temporaryPermissionName} has been deleted successfully."
        );
    }
}
