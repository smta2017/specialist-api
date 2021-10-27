<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialistTypeAPIRequest;
use App\Http\Requests\API\UpdateSpecialistTypeAPIRequest;
use App\Models\SpecialistType;
use App\Repositories\SpecialistTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialistTypeController
 * @package App\Http\Controllers\API
 */

class SpecialistTypeAPIController extends AppBaseController
{
    /** @var  SpecialistTypeRepository */
    private $specialistTypeRepository;

    public function __construct(SpecialistTypeRepository $specialistTypeRepo)
    {
        $this->specialistTypeRepository = $specialistTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistTypes",
     *      summary="Get a listing of the SpecialistTypes.",
     *      tags={"SpecialistType"},
     *      description="Get all SpecialistTypes",
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
     *                  @SWG\Items(ref="#/definitions/SpecialistType")
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
        $specialistTypes = $this->specialistTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialistTypes->toArray(), 'Specialist Types retrieved successfully');
    }

    /**
     * @param CreateSpecialistTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/specialistTypes",
     *      summary="Store a newly created SpecialistType in storage",
     *      tags={"SpecialistType"},
     *      description="Store SpecialistType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistType")
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
     *                  ref="#/definitions/SpecialistType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpecialistTypeAPIRequest $request)
    {
        $input = $request->all();

        $specialistType = $this->specialistTypeRepository->create($input);

        return $this->sendResponse($specialistType->toArray(), 'Specialist Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistTypes/{id}",
     *      summary="Display the specified SpecialistType",
     *      tags={"SpecialistType"},
     *      description="Get SpecialistType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistType",
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
     *                  ref="#/definitions/SpecialistType"
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
        /** @var SpecialistType $specialistType */
        $specialistType = $this->specialistTypeRepository->find($id);

        if (empty($specialistType)) {
            return $this->sendError('Specialist Type not found');
        }

        return $this->sendResponse($specialistType->toArray(), 'Specialist Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpecialistTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/specialistTypes/{id}",
     *      summary="Update the specified SpecialistType in storage",
     *      tags={"SpecialistType"},
     *      description="Update SpecialistType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistType")
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
     *                  ref="#/definitions/SpecialistType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpecialistTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialistType $specialistType */
        $specialistType = $this->specialistTypeRepository->find($id);

        if (empty($specialistType)) {
            return $this->sendError('Specialist Type not found');
        }

        $specialistType = $this->specialistTypeRepository->update($input, $id);

        return $this->sendResponse($specialistType->toArray(), 'SpecialistType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/specialistTypes/{id}",
     *      summary="Remove the specified SpecialistType from storage",
     *      tags={"SpecialistType"},
     *      description="Delete SpecialistType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistType",
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
        /** @var SpecialistType $specialistType */
        $specialistType = $this->specialistTypeRepository->find($id);

        if (empty($specialistType)) {
            return $this->sendError('Specialist Type not found');
        }

        $specialistType->delete();

        return $this->sendSuccess('Specialist Type deleted successfully');
    }
}
