<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\User\IAuth;
use Illuminate\Http\Request;
use Auth;

class AuthController extends AppBaseController
{

    /**
     * @var IAuth
     */
    protected $auth;

    /**
     * AuthController constructor.
     * @param IAuth $auth
     */
    public function __construct(IAuth $auth)
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
        return $this->auth = $auth;
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/auth/login",
     *      summary="User Login",
     *      tags={"Auth"},
     *      description="the system users login",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CustomerAddress that should be updated",
     *          required=false,
     *          @SWG\Schema(example= {
     *                                "email":"santina.veum@example.net",
     *                                "password":"password"
     *                              }
     *          )
     *      ),
     * 
     * )
     */

    public function login()
    {
        $credentials = request(['email', 'password']);
        return $this->auth->loginUser($credentials);
    }




    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *  * @SWG\Post(
     *      path="/auth/register",
     *      summary="User registration",
     *      tags={"Auth"},
     *      description="the system users login",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CustomerAddress that should be updated",
     *          required=false,
     *          @SWG\Schema(example= 
     *               {
     *                "name":"sameh",
     *                "email":"sameh@test.com",
     *                "phone":"01274200778",
     *                "password":"password",
     *                "firebase_token":"2986tGfr56hb5tg6r6f6",
     *                "user_type":"specialist",
     *                "areas":{2,5,1},
     *                "specials":{3,1,2},
     *               }
     *          )
     *      ),
     * 
     * )
     */


    public function register(RegisterRequest $request)
    {
        $user = $this->auth->registerUser($request);
        return  $this->sendResponse($user, "success");
    }



   
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  * @SWG\Post(
     *      path="/auth/me",
     *      summary="User registration",
     *      tags={"Auth"},
     *      description="get user info",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * )
     */

    public function me()
    {
        return ApiResponse::format("sucsess", auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->auth->logout(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->user()->createToken('')->plainTextToken);
    }

    public function forgotPassword(Request $request)
    {
        return $this->auth->forgotPassword($request);
    }
}
