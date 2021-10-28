<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * @SWG\Swagger(
 *   basePath="/api/en/v1",
 *   schemes={"http","https"},
 * 
 * @swg\SecurityScheme(
 *      securityDefinition="Bearer",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *      description="Auth Bearer Token
 *      Format as 'Bearer <access_token>'",
 *  ),
 * 
 * 
 *  
 *
 *   @SWG\Info(
 *     title="Specialist APP APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public static function sendResponse(
        $message = null,
        $data = null,
        $status=true,
        int $code = 200,
        $errors = null,
        $token = null
    ): JsonResponse
    {
        $response = [
            'status'=>$status,
            'message' =>$data,
            'errors' => $errors,
            'data' => $message
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
        $errors = $validator->errors();
        $response = self::sendResponse(false,'Invalid data send', null, 422, $errors->messages());
        throw new HttpResponseException($response);
    }


    // public function sendResponse($result, $message)
    // {
    //     return Response::json(ResponseUtil::makeResponse($message, $result));
    // }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
