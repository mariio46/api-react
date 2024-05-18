<?php

namespace App\Http\Controllers\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserIndexResource;
use App\Http\Resources\User\UserShowResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
        //
    }

    public function index(Request $request): JsonResponse
    {
        $users = $this->userRepositoryInterface->getAllUsers(current_user_id: $request->user()->id);

        return ApiResponse::success(
            data: ['users' => UserIndexResource::collection($users)]
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userRepositoryInterface->storeUser(data: $request->only(['name', 'email', 'password']));

        return ApiResponse::created(
            data: ['user' => new UserIndexResource($user)]
        );
    }

    public function show(string $username): JsonResponse
    {
        $user = $this->userRepositoryInterface->getSingleUser(username: $username);

        return ApiResponse::success(
            data: ['user' => new UserShowResource($user)],
        );
    }

    public function update(UpdateUserRequest $request, string $username): JsonResponse
    {
        $updatedUser = $this->userRepositoryInterface->updateUser(
            data: $request->only(['name', 'username', 'email']),
            username: $username,
        );

        return ApiResponse::success(
            data: ['user' => new UserShowResource($updatedUser)],
        );
    }

    public function delete(string $username): JsonResponse
    {
        $temporaryUserName = $this->userRepositoryInterface->deleteUser($username);

        return ApiResponse::success(
            data: "User with name {$temporaryUserName} has been deleted successfully."
        );
    }
}
