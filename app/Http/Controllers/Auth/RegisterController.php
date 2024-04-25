<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, AuthRepositoryInterface $authRepositoryInterface): JsonResponse
    {
        try {
            $authRepositoryInterface->register(request: $request);
        } catch (Exception $e) {
            return ApiResponse::serverError(
                data: $e->getMessage() ?? null,
            );
        }

        return ApiResponse::created(
            data: 'Register Successfully, Please Login.'
        );
    }
}
