<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestAPIRequest;
use App\Http\Requests\API\UpdateRequestAPIRequest;
use App\Models\Request;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RequestController
 * @package App\Http\Controllers\API
 */

class RequestAPIController extends AppBaseController
{
    /** @var  RequestRepository */
    private $requestRepository;

    public function __construct(RequestRepository $requestRepo)
    {
        $this->requestRepository = $requestRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/requests",
     *      summary="Get a listing of the Requests.",
     *      tags={"Request"},
     *      description="Get all Requests",
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
     *                  @SWG\Items(ref="#/definitions/Request")
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
        $requests = $this->requestRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($requests->toArray(), 'Requests retrieved successfully');
    }

    /**
     * @param CreateRequestAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/requests",
     *      summary="Store a newly created Request in storage",
     *      tags={"Request"},
     *      description="Store Request",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Request that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Request")
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
     *                  ref="#/definitions/Request"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequestAPIRequest $request)
    {
        $input = $request->all();

        $request = $this->requestRepository->create($input);

        return $this->sendResponse($request->toArray(), 'Request saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/requests/{id}",
     *      summary="Display the specified Request",
     *      tags={"Request"},
     *      description="Get Request",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Request",
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
     *                  ref="#/definitions/Request"
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
        /** @var Request $request */
        $request = $this->requestRepository->find($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        return $this->sendResponse($request->toArray(), 'Request retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRequestAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/requests/{id}",
     *      summary="Update the specified Request in storage",
     *      tags={"Request"},
     *      description="Update Request",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Request",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Request that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Request")
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
     *                  ref="#/definitions/Request"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var Request $request */
        $request = $this->requestRepository->find($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        $request = $this->requestRepository->update($input, $id);

        return $this->sendResponse($request->toArray(), 'Request updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/requests/{id}",
     *      summary="Remove the specified Request from storage",
     *      tags={"Request"},
     *      description="Delete Request",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Request",
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
        /** @var Request $request */
        $request = $this->requestRepository->find($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        $request->delete();

        return $this->sendSuccess('Request deleted successfully');
    }
}
