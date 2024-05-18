<?php

namespace App\Http\Controllers\RolePermission;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckPermissionController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (empty($request->input('permissions'))) {
            return ApiResponse::error(
                data: 'We\'re missing permissions from your request. Please ensure you include at least one permission.'
            );
        }

        $validation = Validator::make($request->only('permissions'), ['permissions' => ['required', 'exists:permissions,name']]);

        if ($validation->fails()) {
            return ApiResponse::validationError(
                data: $validation->messages()
            );
        }

        $permissions = $validation->getValue('permissions');

        if (is_array($permissions)) {
            if ($request->user()->canAny($permissions)) {
                return ApiResponse::success(
                    data: (true)
                );
            } else {
                return ApiResponse::Unauthorized(
                    data: (false)
                );
            }
        } else {
            if ($request->user()->can($permissions)) {
                return ApiResponse::success(
                    data: (true)
                );
            } else {
                return ApiResponse::Unauthorized(
                    data: (false)
                );
            }
        }
    }
}
