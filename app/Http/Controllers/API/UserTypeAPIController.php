<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserTypeAPIRequest;
use App\Http\Requests\API\UpdateUserTypeAPIRequest;
use App\Models\UserType;
use App\Repositories\UserTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UserTypeResource;
use Response;

/**
 * Class UserTypeController
 * @package App\Http\Controllers\API
 */

class UserTypeAPIController extends AppBaseController
{
    /** @var  UserTypeRepository */
    private $userTypeRepository;

    public function __construct(UserTypeRepository $userTypeRepo)
    {
        $this->userTypeRepository = $userTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userTypes",
     *      summary="Get a listing of the UserTypes.",
     *      tags={"UserType"},
     *      description="Get all UserTypes",
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
     *                  @SWG\Items(ref="#/definitions/UserType")
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
        $userTypes = $this->userTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        return $this->sendResponse(UserTypeResource::collection($userTypes), 'User Types retrieved successfully');
    }

    /**
     * @param CreateUserTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userTypes",
     *      summary="Store a newly created UserType in storage",
     *      tags={"UserType"},
     *      description="Store UserType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserType")
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
     *                  ref="#/definitions/UserType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserTypeAPIRequest $request)
    {
        $input = $request->all();

        $userType = $this->userTypeRepository->create($input);

        return $this->sendResponse(new UserTypeResource($userType), 'User Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userTypes/{id}",
     *      summary="Display the specified UserType",
     *      tags={"UserType"},
     *      description="Get UserType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserType",
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
     *                  ref="#/definitions/UserType"
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
        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        return $this->sendResponse(new UserTypeResource($userType), 'User Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userTypes/{id}",
     *      summary="Update the specified UserType in storage",
     *      tags={"UserType"},
     *      description="Update UserType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserType")
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
     *                  ref="#/definitions/UserType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        $userType = $this->userTypeRepository->update($input, $id);

        return $this->sendResponse(new UserTypeResource($userType), 'UserType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userTypes/{id}",
     *      summary="Remove the specified UserType from storage",
     *      tags={"UserType"},
     *      description="Delete UserType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserType",
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
        /** @var UserType $userType */
        $userType = $this->userTypeRepository->find($id);

        if (empty($userType)) {
            return $this->sendError('User Type not found');
        }

        $userType->delete();

        return $this->sendSuccess('User Type deleted successfully');
    }
}
