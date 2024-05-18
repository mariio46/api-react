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

    public static function accept(mixed $data, ?string $message = 'Accepted', ?int $code = Response::HTTP_ACCEPTED): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_ACCEPTED
        );
    }

    public static function unauthorized(mixed $data, ?string $message = 'Unauthorized', ?int $code = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_UNAUTHORIZED
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

    public static function notFound(mixed $data, ?string $message = 'Data Not Found', ?int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_NOT_FOUND
        );
    }

    public static function error(mixed $data, ?string $message = 'Bad Request', ?int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $body = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json(
            data: $body,
            status: Response::HTTP_BAD_REQUEST
        );
    }
}
