<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponse
{
    public static function created(mixed $data, ?string $message = 'Created', ?int $code = Response::HTTP_CREATED): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_CREATED
        );
    }

    public static function success(mixed $data, ?string $message = 'Success', ?int $code = Response::HTTP_OK): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_OK
        );
    }

    public static function validationError(mixed $data, ?string $message = 'Validation Failed!', ?int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public static function serverError(mixed $data, ?string $message = 'Something went wrong, please try again later!', ?int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
