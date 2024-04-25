<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthenticatedUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return ApiResponse::success(
            data: ['user' => new AuthenticatedUserResource($request->user())]
        );
    }
}
