<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Requests\API\CreateSubscriptionAPIRequest;
use App\Http\Requests\API\UpdateSubscriptionAPIRequest;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\IdRequest;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Models\Plan;
use Response;

/**
 * Class SubscriptionController
 * @package App\Http\Controllers\API
 */

class SubscriptionAPIController extends AppBaseController
{
    /** @var  SubscriptionRepository */
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepo)
    {
        $this->subscriptionRepository = $subscriptionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/subscriptions",
     *      summary="Get a listing of the Subscriptions.",
     *      tags={"Subscription"},
     *      description="Get all Subscriptions",
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Subscription")
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
        $subscriptions = $this->subscriptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($subscriptions->toArray(), 'Subscriptions retrieved successfully');
    }

    /**
     * @param CreateSubscriptionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/subscriptions",
     *      summary="Store a newly created Subscription in storage",
     *      tags={"Subscription"},
     *      description="Store Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Subscription that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Subscription")
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
     *                  ref="#/definitions/Subscription"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSubscriptionAPIRequest $request)
    {
        $input = $request->all();

        $subscription = $this->subscriptionRepository->create($input);

        return $this->sendResponse($subscription->toArray(), 'Subscription saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/subscriptions/{id}",
     *      summary="Display the specified Subscription",
     *      tags={"Subscription"},
     *      description="Get Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Subscription",
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
     *                  ref="#/definitions/Subscription"
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
        /** @var Subscription $subscription */
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        return $this->sendResponse($subscription->toArray(), 'Subscription retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSubscriptionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/subscriptions/{id}",
     *      summary="Update the specified Subscription in storage",
     *      tags={"Subscription"},
     *      description="Update Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Subscription",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Subscription that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Subscription")
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
     *                  ref="#/definitions/Subscription"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSubscriptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Subscription $subscription */
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        $subscription = $this->subscriptionRepository->update($input, $id);

        return $this->sendResponse($subscription->toArray(), 'Subscription updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/subscriptions/{id}",
     *      summary="Remove the specified Subscription from storage",
     *      tags={"Subscription"},
     *      description="Delete Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Subscription",
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
        /** @var Subscription $subscription */
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            return $this->sendError('Subscription not found');
        }

        $subscription->delete();

        return $this->sendSuccess('Subscription deleted successfully');
    }




    //=============================

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/user-subscribe/{id}",
     *      summary="add Subscribtions for user",
     *      tags={"Subscription"},
     *      description="create Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plan",
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
     *                  ref="#/definitions/Subscription"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function UserSubscribe($id)
    {
        $subscription = $this->subscriptionRepository->storeUserSubscribe($id);

        if (!$subscription) {
            return  ApiResponse::format('subscribe is out of count.');
        }
        return ApiResponse::format('Subscription added as successfully and wating for approved', new SubscriptionResource($subscription));
    }
}
