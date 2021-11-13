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
        $user_types = config('app.user_types');
        // $user_type = json_decode(,true);
        // foreach (config('app.user_types') as $value) {
        //     $user_types =[$value];
        // }

        return ApiResponse::format("user types list", $user_types);
    }
}
