<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Http\JsonResponse;

class ApiExceptionHandler
{
    public static function handle(Throwable $e): JsonResponse
    {
        return match (true) {
            $e instanceof ValidationException => response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422),

            $e instanceof HttpException => response()->json([
                'message' => $e->getMessage() ?: 'Request error'
            ], $e->getStatusCode()),

            default => response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500),
        };
    }
}
