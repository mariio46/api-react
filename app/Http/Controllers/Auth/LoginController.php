<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, AuthRepositoryInterface $authRepositoryInterface): JsonResponse
    {
        try {
            $user = $authRepositoryInterface->login(data: $request->only(['email', 'password']));
        } catch (Exception $th) {
            if ($th instanceof ValidationException) {
                throw $th;
            }

            return ApiResponse::serverError(
                data: $th->getMessage() ?? null
            );
        }

        return ApiResponse::success(
            data: $user,
            message: 'Login Success!'
        );
    }
}
