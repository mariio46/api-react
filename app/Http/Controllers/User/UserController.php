<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserShowResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
        //
    }

    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $users = $this->userRepositoryInterface->getAllUsers(current_user_id: $request->user()->id);
        } catch (Throwable $th) {
            // throw $th;
            if ($th instanceof QueryException) {
                return ApiResponse::serverError(
                    data: 'QueryException ' . $th->getMessage(),
                );
            }

            return ApiResponse::serverError(
                data: null,
            );
        }

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $this->userRepositoryInterface->storeNewUser($request->only(['name', 'email', 'password']));
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage() ?? null
            );
        }

        return ApiResponse::created(
            data: 'User has ben created successfully.'
        );
    }

    public function show(string $username)
    {
        try {
            $user = $this->userRepositoryInterface->getSingleUser(username: $username);
        } catch (Throwable $th) {
            if ($th instanceof NotFoundHttpException) {
                return ApiResponse::notFound(
                    data: "Cannot find User with Username: {$username}",
                );
            }

            return ApiResponse::serverError(
                data: $th->getMessage() ?? null
            );
        }

        return ApiResponse::success(
            data: ['user' => new UserShowResource($user)],
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $new_username = $this->userRepositoryInterface->updateUser(
                data: $request->only(['name', 'username', 'email']),
                user: $user,
            );
        } catch (Throwable $th) {
            return ApiResponse::serverError(
                data: $th->getMessage(),
            );
        }

        return ApiResponse::success(
            data: ['new_username' => $new_username],
        );
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        if ($user == false || $user == null) {
            return ApiResponse::serverError(
                data: null
            );
        } else {
            $user->tokens()->delete();
        }

        return ApiResponse::success(
            data: 'User has been deleted successfully.'
        );
    }
}
