<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rate\ReviewResource;
use App\Repositories\Contracts\User\IUser;
use App\Repositories\Eloquent\User\UserRepository;
use Illuminate\Http\Request;

class RatingAPIController extends Controller
{
    public $model;

    public function __construct(IUser $user)
    {
        $this->model = $user;
    }



    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\get(
     *      path="/user/rate/{id}",
     *      summary="Get a user Rate.",
     *      tags={"User"},
     *      description="Get all Plans",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="user id",
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
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#")
     * 
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getRate($id)
    {
        $user = $this->model->findUser($id);
        $rate = $user->averageRating(1, true)[0];
        $ApprovedRatings = ReviewResource::collection($user->getApprovedRatings($id, 'desc'));
        return ApiResponse::format("success", ['rate' => $rate, 'approvedRatings' => $ApprovedRatings]);
    }



    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\post(
     *      path="/user/rate/{id}",
     *      summary="Get a listing of the Plans.",
     *      tags={"User"},
     *      description="Get all Plans",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="user id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Plan that should be updated",
     *          required=false,
     *          @SWG\Schema(example={"title":"This is a test title","body":"And we will add some shit here","rating":"5" ,  "recommend" :"Yes"})
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
     *                  type="array",
     *                  @SWG\Items(ref="#")
     *                
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request, $id)
    {
        $user = $this->model->findUser($id);

        $rating = $user->rating([
            'title' => $request->title,
            'body' => $request->body,
            'rating' => $request->rating,
            'recommend' => $request->recommend,
            'approved' => env('production') ? false : true, // This is optional and defaults to false
        ], auth()->user());

        return ApiResponse::format("success", new ReviewResource($rating));
    }





    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\put(
     *      path="/user/rate/{user_id}/{rate_id}",
     *      summary="update user rate.",
     *      tags={"User"},
     *      description="update user rate.",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="user_id",
     *          description="user id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="rate_id",
     *          description="Rate id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="",
     *          required=false,
     *          @SWG\Schema(example={"title":"This is a test title","body":"And we will add some shit here","rating":"5" ,  "recommend" :"Yes"})
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
     *                  type="array",
     *                  @SWG\Items(ref="#")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(Request $request, $user_id, $rate_id)
    {
        $user = $this->model->findUser($user_id);

        $rating = $user->updateRating($rate_id, [
            'title' => $request->title,
            'body' => $request->body,
            'rating' => $request->rating,
            'recommend' => $request->recommend,
            'approved' => env('production') ? false : true, // This is optional and defaults to false
        ], auth()->user());

        return ApiResponse::format("success", new ReviewResource($rating));
    }
}
