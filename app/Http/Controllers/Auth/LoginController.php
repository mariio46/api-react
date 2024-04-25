<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthenticatedUserResource;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, AuthRepositoryInterface $authRepositoryInterface): JsonResponse
    {
        try {
            $token = $authRepositoryInterface->login(request: $request);
        } catch (Exception $th) {
            if ($th instanceof ValidationException) {
                throw $th;
                // return ApiResponse::validationError(
                //     data: $th->getMessage()
                // );
            }

            return ApiResponse::serverError(
                data: null
            );
        }

        return ApiResponse::success(
            data: [
                'user' => new AuthenticatedUserResource($request->user()),
                'token' => $token,
            ],
            message: 'Login Success!'
        );
    }
}
