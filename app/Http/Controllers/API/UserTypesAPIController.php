<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserTypesAPIController extends Controller
{
    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userTypes",
     *      summary="Geting user types in system",
     *      tags={"Auth"},
     *      description="Get Subscription",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *       
     *      )
     * )
     */
    public function index()
    {
        $user_types = [
                ['customer'=>'customer'],
                ['specialist'=>'specialist'],
                ['libirary'=>'libirary'],
                ['center'=>'center'],
        ];

        return ApiResponse::format("user types list", $user_types);
    }
}
