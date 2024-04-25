<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();
        } catch (\Throwable $th) {
            return ApiResponse::serverError(
                data: null
            );
        }

        return ApiResponse::success(
            data: null,
            message: 'Logout Success!'
        );
    }
}
