<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param mixed $data
     * @param int $status
     * @param string $message
     * @return JsonResponse
     */
    public function successWithData(mixed $data, string $message='success', int $status=200): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status
        );
    }

    /**
     * @param int $status
     * @param string $message
     * @return JsonResponse
     */
    public function success(string $message='success', int $status=200): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
            ], $status
        );
    }

    /**
     * @param mixed $errors
     * @param int $status
     * @return JsonResponse
     */
    public function error(mixed $errors, int $status=400): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => $errors->getCode(). ':' . $errors->getMessage(),
                'data' => [
                    'message' => $errors->getMessage(),
                    'code' => $errors->getCode(),
                ],
            ], $status
        );
    }

    /**
     * @param MessageBag $errors
     * @param int $status
     * @return JsonResponse
     */
    public function validationError(MessageBag $errors, int $status=400): JsonResponse
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'Validation Error',
                'data' => $errors,
            ], $status
        );
    }

    /**
     * @param array $response
     * @return JsonResponse
     */
    public function customResponse(array $response): JsonResponse
    {
        return response()->json($response['response'], $response['status']);
    }
}
