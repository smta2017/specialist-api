<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Contracts\User\IUser;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CustomerAddress\CustomerAddressResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Resources\User\UserResource;

class UserController extends AppBaseController
{
    /**
     * @var IUser
     */
    protected $user;

    /**
     * AuthController constructor.
     * @param IUser $user
     */
    public function __construct(IUser $user)
    {
        return $this->user = $user;
    }

    public function tuserProfile($id)
    {
        return $this->user->userProfile($id);
    }
    /**
     * verify phone OTP.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @param int $id
     * @return mixed
     *
     * @SWG\Get(
     *      path="/users",
     *      summary="Display the specified Subscription",
     *      tags={"Auth"},
     *      description="Verify OTP code",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="user_type",
     *          description="user_type_id",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
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
     *                  ref="#"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        // return $request->all();
        $user = User::query();
        if ($request->user_type_id) {
            $user = $user->where('user_type_id', $request->user_type_id);
        }
        $users =  $user->get();


        // $user = $this->model->findUser($id);
        // $rate = $user->averageRating(1, true);
        // $ApprovedRatings = ReviewResource::collection($user->getApprovedRatings($id, 'desc'));


        return ApiResponse::format('Users geting successfully', UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        return $this->user->createUser($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->user->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        return $this->user->updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->user->deleteUser($id);
    }

    //------------customer--------


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialist/{area_id}",
     *      summary="Display the specialist by Area",
     *      tags={"Order-Specialist"},
     *      description="Get Area",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="area_id",
     *          description="id of Area",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
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
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function getSpcByArea($area_id)
    {
        $specialist = $this->user->getSpecialistByArea($area_id);
        return ApiResponse::format("success", $specialist);
    }
}
