<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderCommentAPIRequest;
use App\Http\Requests\API\UpdateOrderCommentAPIRequest;
use App\Models\OrderComment;
use App\Repositories\OrderCommentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrderCommentController
 * @package App\Http\Controllers\API
 */

class OrderCommentAPIController extends AppBaseController
{
    /** @var  OrderCommentRepository */
    private $orderCommentRepository;

    public function __construct(OrderCommentRepository $orderCommentRepo)
    {
        $this->orderCommentRepository = $orderCommentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderComments",
     *      summary="Get a listing of the OrderComments.",
     *      tags={"OrderComment"},
     *      description="Get all OrderComments",
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
     *                  @SWG\Items(ref="#/definitions/OrderComment")
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
        $orderComments = $this->orderCommentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderComments->toArray(), 'Order Comments retrieved successfully');
    }

    /**
     * @param CreateOrderCommentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderComments",
     *      summary="Store a newly created OrderComment in storage",
     *      tags={"OrderComment"},
     *      description="Store OrderComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderComment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderComment")
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
     *                  ref="#/definitions/OrderComment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderCommentAPIRequest $request)
    {
        $input = $request->all();

        $orderComment = $this->orderCommentRepository->create($input);

        return $this->sendResponse($orderComment->toArray(), 'Order Comment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderComments/{id}",
     *      summary="Display the specified OrderComment",
     *      tags={"OrderComment"},
     *      description="Get OrderComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderComment",
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
     *                  ref="#/definitions/OrderComment"
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
        /** @var OrderComment $orderComment */
        $orderComment = $this->orderCommentRepository->find($id);

        if (empty($orderComment)) {
            return $this->sendError('Order Comment not found');
        }

        return $this->sendResponse($orderComment->toArray(), 'Order Comment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderCommentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderComments/{id}",
     *      summary="Update the specified OrderComment in storage",
     *      tags={"OrderComment"},
     *      description="Update OrderComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderComment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderComment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderComment")
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
     *                  ref="#/definitions/OrderComment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderCommentAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderComment $orderComment */
        $orderComment = $this->orderCommentRepository->find($id);

        if (empty($orderComment)) {
            return $this->sendError('Order Comment not found');
        }

        $orderComment = $this->orderCommentRepository->update($input, $id);

        return $this->sendResponse($orderComment->toArray(), 'OrderComment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderComments/{id}",
     *      summary="Remove the specified OrderComment from storage",
     *      tags={"OrderComment"},
     *      description="Delete OrderComment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderComment",
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
        /** @var OrderComment $orderComment */
        $orderComment = $this->orderCommentRepository->find($id);

        if (empty($orderComment)) {
            return $this->sendError('Order Comment not found');
        }

        $orderComment->delete();

        return $this->sendSuccess('Order Comment deleted successfully');
    }
}
