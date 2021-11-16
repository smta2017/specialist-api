<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialTypesAPIRequest;
use App\Http\Requests\API\UpdateSpecialTypesAPIRequest;
use App\Models\SpecialTypes;
use App\Repositories\SpecialTypesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialTypesController
 * @package App\Http\Controllers\API
 */

class SpecialTypesAPIController extends AppBaseController
{
    /** @var  SpecialTypesRepository */
    private $specialTypesRepository;

    public function __construct(SpecialTypesRepository $specialTypesRepo)
    {
        $this->specialTypesRepository = $specialTypesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialTypes",
     *      summary="Get a listing of the SpecialTypes.",
     *      tags={"SpecialTypes"},
     *      description="Get all SpecialTypes",
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
     *                  @SWG\Items(ref="#/definitions/SpecialTypes")
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
        $specialTypes = $this->specialTypesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialTypes->toArray(), 'Special Types retrieved successfully');
    }

    /**
     * @param CreateSpecialTypesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/specialTypes",
     *      summary="Store a newly created SpecialTypes in storage",
     *      tags={"SpecialTypes"},
     *      description="Store SpecialTypes",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialTypes that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialTypes")
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
     *                  ref="#/definitions/SpecialTypes"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpecialTypesAPIRequest $request)
    {
        $input = $request->all();

        $specialTypes = $this->specialTypesRepository->create($input);

        return $this->sendResponse($specialTypes->toArray(), 'Special Types saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialTypes/{id}",
     *      summary="Display the specified SpecialTypes",
     *      tags={"SpecialTypes"},
     *      description="Get SpecialTypes",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialTypes",
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
     *                  ref="#/definitions/SpecialTypes"
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
        /** @var SpecialTypes $specialTypes */
        $specialTypes = $this->specialTypesRepository->find($id);

        if (empty($specialTypes)) {
            return $this->sendError('Special Types not found');
        }

        return $this->sendResponse($specialTypes->toArray(), 'Special Types retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpecialTypesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/specialTypes/{id}",
     *      summary="Update the specified SpecialTypes in storage",
     *      tags={"SpecialTypes"},
     *      description="Update SpecialTypes",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialTypes",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialTypes that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialTypes")
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
     *                  ref="#/definitions/SpecialTypes"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpecialTypesAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialTypes $specialTypes */
        $specialTypes = $this->specialTypesRepository->find($id);

        if (empty($specialTypes)) {
            return $this->sendError('Special Types not found');
        }

        $specialTypes = $this->specialTypesRepository->update($input, $id);

        return $this->sendResponse($specialTypes->toArray(), 'SpecialTypes updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/specialTypes/{id}",
     *      summary="Remove the specified SpecialTypes from storage",
     *      tags={"SpecialTypes"},
     *      description="Delete SpecialTypes",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialTypes",
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
        /** @var SpecialTypes $specialTypes */
        $specialTypes = $this->specialTypesRepository->find($id);

        if (empty($specialTypes)) {
            return $this->sendError('Special Types not found');
        }

        $specialTypes->delete();

        return $this->sendSuccess('Special Types deleted successfully');
    }
}
