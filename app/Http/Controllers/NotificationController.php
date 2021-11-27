<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\GeneralNotification;

class NotificationController extends Controller
{



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
     * @SWG\Get(
     *      path="/users/notifications",
     *      summary="get user notifications",
     *      tags={"User"},
     *      description="user notifications",
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
    public function notifications()
    {
        $user = auth()->user();
        return ApiResponse::format('notifications', $user->notifications);
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
     * @SWG\Get(
     *      path="/users/unread-notifications",
     *      summary="get user unread-notifications",
     *      tags={"User"},
     *      description="user notifications",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
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
    public function unReadNotifications()
    {
        $user = auth()->user();
        return ApiResponse::format('unread notifications', $user->unreadNotifications);
    }




    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @param int $id
     * @return mixed
     *
     * @SWG\Get(
     *      path="/users/notifications/{id}/mark-read",
     *      summary="update user profile",
     *      tags={"User"},
     *      description="update user",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *  @SWG\Parameter(
     *          name="id",
     *          description="id of notification",
     *          type="string",
     *          required=true,
     *          in="path"
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
    public function markAsRead($id)
    {
        $notifys = auth()->user()->notifications->find($id);
        return ApiResponse::format('Succsess Marked As Read ', $notifys);
    }
}
