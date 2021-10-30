<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param null $message
     * @param null $data
     * @param int $code
     * @param null $errors
     * @param null $token
     * @return JsonResponse
     */
    public static function format(
        $message = null,
        $data = null,
        $status = true,
        int $code = 200,
        $errors = null,
        $token = null
    ): JsonResponse {
        $response = [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ];

        if ($token) $response = array_merge($response, ['token' => $token]);

        return response()->json($response, $code);
    }

    /**
     * This function apiResponseValidation for Validation Request
     * @param $validator
     */
    public static function apiFormatValidation($validator)
    {
        $errors = self::convertValidationErrors($validator->errors());
        $response = self::format('Invalid data send', 'invalid_validation', false, 422, $errors);
        throw new HttpResponseException($response);
    }

    public static function convertValidationErrors($errors)
    {
        $err_msg = [];
        foreach ($errors->messages() as $key => $value) {
            $err_msg[$key] = $value[0];
        };
        return $err_msg;
    }
}
