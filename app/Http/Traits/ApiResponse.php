<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponse
{
    public static ResponseAlias $responseCode;

    public function __construct()
    {
        self::$responseCode = new ResponseAlias();
    }

    /**
     * @param mixed $data
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(
        mixed $data = null,
        string $message = null,
        int $statusCode = ResponseAlias::HTTP_OK
    ): JsonResponse {
        $message = $message == '' || $message == null ? 'Success' : $message;
        $responseData = [
            'success'       => $statusCode >= 200 && $statusCode < 300,
            'status_code'   => $statusCode,
            'data'          => $data,
            'message'       => $message,
            'errors'        => null,
        ];
        return response()->json($responseData, $statusCode);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @param array|null $errors
     * @return JsonResponse
     */
    public function error(string $message, int $statusCode, array|null $errors = null): JsonResponse
    {
        $responseData = [
            'success'       => $statusCode >= 200 && $statusCode < 300,
            'status_code'   => $statusCode,
            'data'          => null,
            'message'       => $message,
            'errors'        => $errors ?? [],
        ];
        return response()->json($responseData, $statusCode);
    }
}
