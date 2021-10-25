<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="L8 OpenApi laravel",
     *      description="laravel Api's documentation"
     * )
     *
     * 
     * @OA\Server(
     *      url="{schema}://talsystem.com/api/{lang}/v1",
     *      description="dev",
     *      @OA\ServerVariable(
     *          serverVariable="schema",
     *          enum={"https", "http"},
     *          default="https"
     *      ),
     * 
     *      @OA\ServerVariable(
     *          serverVariable="lang",
     *          enum={"en", "ar"},
     *          default="en"
     *      )
     * )
     *
     * 
     * @OA\Server(
     *      url="{schema}://laravel.com/api/{lang}/v1",
     *      description="Live",
     *      @OA\ServerVariable(
     *          serverVariable="schema",
     *          enum={"https", "http"},
     *          default="https"
     *      ),
     * 
     *      @OA\ServerVariable(
     *          serverVariable="lang",
     *          enum={"en", "ar"},
     *          default="en"
     *      )
     * )
     * 
     *   @OA\Server(
     *      url="{schema}://test.laravel.com/api/{lang}/v1",
     *      description="test",
     *      @OA\ServerVariable(
     *          serverVariable="schema",
     *          enum={"https", "http"},
     *          default="https"
     *      ),
     * 
     *      @OA\ServerVariable(
     *          serverVariable="lang",
     *          enum={"en", "ar"},
     *          default="en"
     *      )
     * )
     * )
     * 
     *   @OA\Server(
     *      url="{schema}://laravel.test/api/{lang}/v1",
     *      description="Local",
     *      @OA\ServerVariable(
     *          serverVariable="schema",
     *          enum={"https", "http"},
     *          default="http"
     *      ),
     * 
     *      @OA\ServerVariable(
     *          serverVariable="lang",
     *          enum={"en", "ar"},
     *          default="en"
     *      )
     * )
     * )
     * 
     *    @OA\Tag(
     *     name="system",
     *     description="Access to system End-points",
     * )
     *
     * 
     * 
     * 
     * 
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth",
     * )
     */


   
}
