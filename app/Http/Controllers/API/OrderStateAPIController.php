<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderStateAPIRequest;
use App\Http\Requests\API\UpdateOrderStateAPIRequest;
use App\Models\OrderState;
use App\Repositories\OrderStateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderState\OrderStateResource;
use Response;

/**
 * Class OrderStateController
 * @package App\Http\Controllers\API
 */

class OrderStateAPIController extends AppBaseController
{
    /** @var  OrderStateRepository */
    private $orderStateRepository;

    public function __construct(OrderStateRepository $orderStateRepo)
    {
        $this->orderStateRepository = $orderStateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderStates",
     *      summary="Get a listing of the OrderStates.",
     *      tags={"OrderState"},
     *      description="Get all OrderStates",
     *      security = {{"Bearer": {}}},
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
     *                  @SWG\Items(ref="#/definitions/OrderState")
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
        $orderStates = $this->orderStateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(OrderStateResource::collection($orderStates), 'Order States retrieved successfully');
    }

    /**
     * @param CreateOrderStateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/orderStates",
     *      summary="Store a newly created OrderState in storage",
     *      tags={"OrderState"},
     *      description="Store OrderState",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderState that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderState")
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
     *                  ref="#/definitions/OrderState"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrderStateAPIRequest $request)
    {
        $input = $request->all();

        $orderState = $this->orderStateRepository->create($input);

        return $this->sendResponse(new OrderStateResource($orderState), 'Order State saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/orderStates/{id}",
     *      summary="Display the specified OrderState",
     *      tags={"OrderState"},
     *      description="Get OrderState",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderState",
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
     *                  ref="#/definitions/OrderState"
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
        /** @var OrderState $orderState */
        $orderState = $this->orderStateRepository->find($id);

        if (empty($orderState)) {
            return $this->sendError('Order State not found');
        }

        return $this->sendResponse(new OrderStateResource($orderState), 'Order State retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrderStateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/orderStates/{id}",
     *      summary="Update the specified OrderState in storage",
     *      tags={"OrderState"},
     *      description="Update OrderState",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderState",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OrderState that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OrderState")
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
     *                  ref="#/definitions/OrderState"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrderStateAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderState $orderState */
        $orderState = $this->orderStateRepository->find($id);

        if (empty($orderState)) {
            return $this->sendError('Order State not found');
        }

        $orderState = $this->orderStateRepository->update($input, $id);

        return $this->sendResponse(new OrderStateResource($orderState), 'OrderState updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/orderStates/{id}",
     *      summary="Remove the specified OrderState from storage",
     *      tags={"OrderState"},
     *      description="Delete OrderState",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OrderState",
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
        /** @var OrderState $orderState */
        $orderState = $this->orderStateRepository->find($id);

        if (empty($orderState)) {
            return $this->sendError('Order State not found');
        }

        $orderState->delete();

        return $this->sendSuccess('Order State deleted successfully');
    }
}
