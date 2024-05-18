<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Throwable;

class ApplicationStatusController extends Controller
{
    public function __invoke()
    {
        try {
            return ApiResponse::success(
                data: 'Server is ok.'
            );
        } catch (Throwable $th) {
            // throw $th;
            return ApiResponse::serverError(
                data: $th->getMessage() ?? 'Server is not ok.'
            );
        }
    }
}
