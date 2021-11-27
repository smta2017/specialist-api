<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Requests\API\CreateChatAPIRequest;
use App\Http\Requests\API\UpdateChatAPIRequest;
use App\Models\Chat;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ChatResource;
use Response;

/**
 * Class ChatController
 * @package App\Http\Controllers\API
 */

class ChatAPIController extends AppBaseController
{
    /** @var  ChatRepository */
    private $chatRepository;

    public function __construct(ChatRepository $chatRepo)
    {
        $this->chatRepository = $chatRepo;
    }

    public function index(Request $request)
    {
        $chats = $this->chatRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return ApiResponse::format('Chats retrieved successfully' ,ChatResource::collection($chats));
    }


    public function store(CreateChatAPIRequest $request)
    {
        $input = $request->all();

        $chat = $this->chatRepository->create($input);

        return ApiResponse::format('Chat saved successfully' ,new ChatResource($chat));
    }

 
    public function show($id)
    {
        /** @var Chat $chat */
        $chat = $this->chatRepository->find($id);

        if (empty($chat)) {
            return $this->sendError('Chat not found');
        }

        return ApiResponse::format('Chat retrieved successfully' ,new ChatResource($chat));
    }

    public function update($id, UpdateChatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Chat $chat */
        $chat = $this->chatRepository->find($id);

        if (empty($chat)) {
            return $this->sendError('Chat not found');
        }

        $chat = $this->chatRepository->update($input, $id);

        return ApiResponse::format('Chat updated successfully' ,new ChatResource($chat));
    }

    public function destroy($id)
    {
        /** @var Chat $chat */
        $chat = $this->chatRepository->find($id);

        if (empty($chat)) {
            return $this->sendError('Chat not found');
        }

        $chat->delete();

        return $this->sendSuccess('Chat deleted successfully');
    }




    /**
     * @param int $id
     * @param UpdateChatAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/chats/send",
     *      summary="Update the specified Chat in storage",
     *      tags={"Chat"},
     *      description="Update Chat",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *   
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Chat that should be updated",
     *          required=false,
     *          @SWG\Schema(example={"to_user_id":2,"msg":"hello"})
     *
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
    public function send(Request $request)
    {
        $input = $request->all();
        $chat = $this->chatRepository->create(['from_user' => auth()->user()->id, 'to_user' => $input['to_user_id'], 'msg' => $input['msg']]);

        return ApiResponse::format('Chat saved successfully' ,new ChatResource($chat));
    }



    /**
     * @param int $id
     * @param UpdateChatAPIRequest $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/chats/{user_id}",
     *      summary="Update the specified Chat in storage",
     *      tags={"Chat"},
     *      description="Update Chat",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="user_id",
     *          description="id of user",
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
    public function conversation(Request $request,$user_id)
    {
       
       $chats= Chat::where('to_user',$user_id)->where('from_user',auth()->user()->id)->get();

        return ApiResponse::format('Chats retrieved successfully' ,ChatResource::collection($chats));
  
    }

      /**
     * @param int $id
     * @param UpdateChatAPIRequest $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/chats",
     *      summary="Update the specified Chat in storage",
     *      tags={"Chat"},
     *      description="Update Chat",
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
    public function conversations()
    {
       
       $chats= Chat::select('from_user','to_user')->where('from_user',auth()->user()->id)->groupBy('from_user','to_user')->get();

        return ApiResponse::format('Chats retrieved successfully' ,ChatResource::collection($chats));
  
    }
}
