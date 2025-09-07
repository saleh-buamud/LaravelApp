<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ApiExceptionHandler
{
    /**
     * Handle API exceptions and return consistent JSON responses
     */
    public static function handle(\Throwable $exception, Request $request): ?JsonResponse
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ValidationException) {
                return self::handleValidationException($exception);
            }

            if ($exception instanceof ModelNotFoundException) {
                return self::handleModelNotFoundException($exception);
            }

            if ($exception instanceof AuthenticationException) {
                return self::handleAuthenticationException($exception);
            }

            if ($exception instanceof NotFoundHttpException) {
                return self::handleNotFoundHttpException($exception);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return self::handleMethodNotAllowedHttpException($exception);
            }

            return self::handleGenericException($exception);
        }

        return null;
    }

    /**
     * Handle validation exceptions
     */
    private static function handleValidationException(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $exception->errors(),
        ], 422);
    }

    /**
     * Handle model not found exceptions
     */
    private static function handleModelNotFoundException(ModelNotFoundException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Resource not found',
        ], 404);
    }

    /**
     * Handle authentication exceptions
     */
    private static function handleAuthenticationException(AuthenticationException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated',
        ], 401);
    }

    /**
     * Handle not found HTTP exceptions
     */
    private static function handleNotFoundHttpException(NotFoundHttpException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Endpoint not found',
        ], 404);
    }

    /**
     * Handle method not allowed HTTP exceptions
     */
    private static function handleMethodNotAllowedHttpException(MethodNotAllowedHttpException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Method not allowed',
        ], 405);
    }

    /**
     * Handle generic exceptions
     */
    private static function handleGenericException(\Throwable $exception): JsonResponse
    {
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
        
        return response()->json([
            'success' => false,
            'message' => config('app.debug') ? $exception->getMessage() : 'Internal server error',
        ], $statusCode);
    }
}
