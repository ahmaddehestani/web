<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function successResponse($data = [], string $message = '', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    public function errorResponse( $errorMessages ='', $statusCode = 400):JsonResponse
    {
        return response()->json([
            'message' => $errorMessages,
        ], $statusCode);
    }
    public function resultWithAdditional($data = [], string $message = null, $status = 200, $additional = []): JsonResponse
    {
        return $data->additional(array_merge([
            'message' => $message??''
        ], $additional))->response()->setStatusCode($status);
    }

}
