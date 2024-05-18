<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->merge(new PermissionBaseResource($this)),
            'roles_count' => $this->roles_count ?? 0,
        ];
    }
}
