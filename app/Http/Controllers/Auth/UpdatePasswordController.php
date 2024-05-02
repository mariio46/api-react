<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Throwable;

class UpdatePasswordController extends Controller
{
    public function __invoke(UpdatePasswordRequest $request, AuthRepositoryInterface $authRepositoryInterface)
    {
        try {
            $authRepositoryInterface->updatePassword(data: $request->only(['password']), user: $request->user());
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage(),
            );
        }

        return ApiResponse::success(
            data: null,
            message: 'Password Updated, Please login again.'
        );
    }
}
