<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * @param string $message
     * @param int $statusCode
     * @param array $data
     * @return JsonResponse
     */
    public function jsonResponse(string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse(string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        return $this->jsonResponse($message, $data, $statusCode);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function errorResponse(string $message, array $data = [], int $statusCode = 400): JsonResponse
    {
        return $this->jsonResponse($message, $data, $statusCode);
    }
}
