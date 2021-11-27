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
use Illuminate\Support\Facades\Mail;

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


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      consumes={"multipart/form-data"},
     *      path="/users/{id}/avatar",
     *      summary="save avatar to storage",
     *      tags={"User"},
     *      description="Delete Plan",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="user id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="avatar",
     *          description="user photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     * 
     *     @SWG\Response(
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
     *      )
     * )
     */

    public function updateAvatar(Request $request, $id)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'avatar' => 'required|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if ($files = $request->file('avatar')) {

            //store file into document folder
            $file = $request->avatar->store('public/user');

            //store your file into database
            $user =  User::find($id);
            $user->avatar = substr($file, 7);
            $user->save();
            return ApiResponse::format('Users geting successfully', new UserResource($user));
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      consumes={"multipart/form-data"},
     *      path="/users/{id}/edu",
     *      summary="save educatios to storage",
     *      tags={"User"},
     *      description="Delete Plan",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="user id",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *     
     * 
     *      @SWG\Parameter(
     *          name="edu1",
     *          description="user photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     *      @SWG\Parameter(
     *          name="edu2",
     *          description="user photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     *      @SWG\Parameter(
     *          name="edu3",
     *          description="user photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     *      @SWG\Parameter(
     *          name="edu4",
     *          description="user photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     * 
     *     @SWG\Response(
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
     *      )
     * )
     */

    public function updateEdu(Request $request, $id)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'edu1' => 'required|max:2048',
                'edu3' => 'required|max:2048',
                'edu3' => 'required|max:2048',
                'edu4' => 'required|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }



        if ($files = $request->file('edu1')) {

            //store file into document folder
            $file = $request->edu1->store('public/users/edu');

            //store your file into database
            $user =  User::find($id);
            $user->edu1 = substr($file, 7);
            $user->save();
        }

        if ($files = $request->file('edu2')) {

            //store file into document folder
            $file = $request->edu2->store('public/users/edu');

            //store your file into database
            $user =  User::find($id);
            $user->edu2 = substr($file, 7);
            $user->save();
        }

        if ($files = $request->file('edu3')) {

            //store file into document folder
            $file = $request->edu3->store('public/users/edu');

            //store your file into database
            $user =  User::find($id);
            $user->edu3 = substr($file, 7);
            $user->save();
        }

        if ($files = $request->file('edu4')) {

            //store file into document folder
            $file = $request->edu4->store('public/users/edu');

            //store your file into database
            $user =  User::find($id);
            $user->edu4 = substr($file, 7);
            $user->save();
        }
        return ApiResponse::format('Users geting successfully', new UserResource($user));
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
     *          name="user_type_id",
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
        $users =  $user->with('CustomerAddresses')->get();

        // return $users;

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
     * @return \Illuminate\Http\JsonResponse
     *
     * @param int $id
     * @return mixed
     *
     * @SWG\Get(
     *      path="/users/{id}",
     *      summary="Display the specified Subscription",
     *      tags={"User"},
     *      description="Verify OTP code",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *       @SWG\Parameter(
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
    public function show($id)
    {
        return ApiResponse::format('Users geting successfully', new UserResource($this->user->find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @param int $id
     * @return mixed
     *
     * @SWG\Put(
     *      path="/users/{id}",
     *      summary="update user profile",
     *      tags={"User"},
     *      description="update user",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *  @SWG\Parameter(
     *          name="id",
     *          description="id of Plan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="profile",
     *          required=false,
     *          @SWG\Schema(example={
     *                   "name": "admin",
     *                   "email": "admin@admin.com",
     *                   "phone": null,
     *                   "sms_notification": 1,
     *                   "notes": "uuytt",
     *                   "lang": "ar"})
     *      ),
     * 
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

    public function update(UserUpdateRequest $request, $id)
    {
        // return $request->all();
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


    /**
     * Update the specified resource in storage.
     *
     *
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @param int $id
     * @return mixed
     *
     * @SWG\get(
     *      path="/contactus",
     *      summary="update user profile",
     *      tags={"User"},
     *      description="update user",
     *      produces={"application/json"},
     *  @SWG\Parameter(
     *          name="title",
     *          description="title of contact",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *  @SWG\Parameter(
     *          name="body",
     *          description="body of contact",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     * 
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


    public function contactus(Request $request)
    {

        $customer = User::find(3);
        $mail =  Mail::send('emails.contact', (['title' => $request->title, 'body' => $request->body]), function ($m) use ($customer) {
            $m->from('info@a5essai.com', 'a5essai');
            $m->to('smta0@yahoo.com');
            $m->subject('contact');
        });
        return ApiResponse::format('Email sent.', $mail);
    }
}
