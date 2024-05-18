<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateAccountRequest;
use App\Http\Resources\Auth\AuthenticatedUserResource;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Throwable;

class UpdateAccountController extends Controller
{
    public function __invoke(UpdateAccountRequest $request, AuthRepositoryInterface $authRepositoryInterface): JsonResponse
    {
        try {
            $user = $authRepositoryInterface->updateAccount(data: $request->only(['name', 'username', 'email']), user: $request->user());
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage(),
            );
        }

        return ApiResponse::success(
            data: ['user' => new AuthenticatedUserResource($user)],
            message: 'Update Account Success',
        );
    }
}
