<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function apiResponse($data = null, $message = null, $status = 200): JsonResponse
    {
        $responseData = [
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($responseData, $status);
    }
}
