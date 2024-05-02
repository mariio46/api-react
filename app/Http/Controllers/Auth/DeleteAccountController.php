<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DeleteAccountRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Throwable;

class DeleteAccountController extends Controller
{
    public function __invoke(DeleteAccountRequest $request, AuthRepositoryInterface $authRepositoryInterface)
    {
        try {
            $authRepositoryInterface->deleteAccount(user: $request->user());
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage(),
            );
        }

        return ApiResponse::success(
            data: null,
            message: 'Delete account success, goodbye.',
        );
    }
}
