<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

class CheckTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            if (auth('sanctum')->check()) {
                return ApiResponse::success(
                    data: 'Authenticated.'
                );
            } else {
                return ApiResponse::Unauthorized(
                    data: 'Unauthenticated.'
                );
            }
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage() ?? null
            );
        }
    }
}
