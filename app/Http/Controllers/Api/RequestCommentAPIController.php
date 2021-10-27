<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestCommentAPIRequest;
use App\Http\Requests\API\UpdateRequestCommentAPIRequest;
use App\Models\RequestComment;
use App\Repositories\RequestCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RequestCommentController
 * @package App\Http\Controllers\API
 */

class RequestCommentAPIController extends AppBaseController
{
    /** @var  RequestCommentRepository */
    private $requestCommentRepository;

    public function __construct(RequestCommentRepository $requestCommentRepo)
    {
        $this->requestCommentRepository = $requestCommentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestComments",
     *      summary="Get a listing of the RequestComments.",
     *      tags={"RequestComment"},
     *      description="Get all RequestComments",
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/RequestComment")
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
        $requestComments = $this->requestCommentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($requestComments->toArray(), 'Request Comments retrieved successfully');
    }

    /**
     * @param CreateRequestCommentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/requestComments",
     *      summary="Store a newly created RequestComment in storage",
     *      tags={"RequestComment"},
     *      description="Store RequestComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestComment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestComment")
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
     *                  ref="#/definitions/RequestComment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequestCommentAPIRequest $request)
    {
        $input = $request->all();

        $requestComment = $this->requestCommentRepository->create($input);

        return $this->sendResponse($requestComment->toArray(), 'Request Comment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/requestComments/{id}",
     *      summary="Display the specified RequestComment",
     *      tags={"RequestComment"},
     *      description="Get RequestComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestComment",
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
     *                  ref="#/definitions/RequestComment"
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
        /** @var RequestComment $requestComment */
        $requestComment = $this->requestCommentRepository->find($id);

        if (empty($requestComment)) {
            return $this->sendError('Request Comment not found');
        }

        return $this->sendResponse($requestComment->toArray(), 'Request Comment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRequestCommentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/requestComments/{id}",
     *      summary="Update the specified RequestComment in storage",
     *      tags={"RequestComment"},
     *      description="Update RequestComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestComment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RequestComment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RequestComment")
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
     *                  ref="#/definitions/RequestComment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequestCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var RequestComment $requestComment */
        $requestComment = $this->requestCommentRepository->find($id);

        if (empty($requestComment)) {
            return $this->sendError('Request Comment not found');
        }

        $requestComment = $this->requestCommentRepository->update($input, $id);

        return $this->sendResponse($requestComment->toArray(), 'RequestComment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/requestComments/{id}",
     *      summary="Remove the specified RequestComment from storage",
     *      tags={"RequestComment"},
     *      description="Delete RequestComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RequestComment",
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
    public function destroy($id)
    {
        /** @var RequestComment $requestComment */
        $requestComment = $this->requestCommentRepository->find($id);

        if (empty($requestComment)) {
            return $this->sendError('Request Comment not found');
        }

        $requestComment->delete();

        return $this->sendSuccess('Request Comment deleted successfully');
    }
}
