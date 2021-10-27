<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialistAreaAPIRequest;
use App\Http\Requests\API\UpdateSpecialistAreaAPIRequest;
use App\Models\SpecialistArea;
use App\Repositories\SpecialistAreaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialistAreaController
 * @package App\Http\Controllers\API
 */

class SpecialistAreaAPIController extends AppBaseController
{
    /** @var  SpecialistAreaRepository */
    private $specialistAreaRepository;

    public function __construct(SpecialistAreaRepository $specialistAreaRepo)
    {
        $this->specialistAreaRepository = $specialistAreaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistAreas",
     *      summary="Get a listing of the SpecialistAreas.",
     *      tags={"SpecialistArea"},
     *      description="Get all SpecialistAreas",
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
     *                  @SWG\Items(ref="#/definitions/SpecialistArea")
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
        $specialistAreas = $this->specialistAreaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialistAreas->toArray(), 'Specialist Areas retrieved successfully');
    }

    /**
     * @param CreateSpecialistAreaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/specialistAreas",
     *      summary="Store a newly created SpecialistArea in storage",
     *      tags={"SpecialistArea"},
     *      description="Store SpecialistArea",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistArea that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistArea")
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
     *                  ref="#/definitions/SpecialistArea"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpecialistAreaAPIRequest $request)
    {
        $input = $request->all();

        $specialistArea = $this->specialistAreaRepository->create($input);

        return $this->sendResponse($specialistArea->toArray(), 'Specialist Area saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistAreas/{id}",
     *      summary="Display the specified SpecialistArea",
     *      tags={"SpecialistArea"},
     *      description="Get SpecialistArea",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistArea",
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
     *                  ref="#/definitions/SpecialistArea"
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
        /** @var SpecialistArea $specialistArea */
        $specialistArea = $this->specialistAreaRepository->find($id);

        if (empty($specialistArea)) {
            return $this->sendError('Specialist Area not found');
        }

        return $this->sendResponse($specialistArea->toArray(), 'Specialist Area retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpecialistAreaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/specialistAreas/{id}",
     *      summary="Update the specified SpecialistArea in storage",
     *      tags={"SpecialistArea"},
     *      description="Update SpecialistArea",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistArea",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistArea that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistArea")
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
     *                  ref="#/definitions/SpecialistArea"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpecialistAreaAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialistArea $specialistArea */
        $specialistArea = $this->specialistAreaRepository->find($id);

        if (empty($specialistArea)) {
            return $this->sendError('Specialist Area not found');
        }

        $specialistArea = $this->specialistAreaRepository->update($input, $id);

        return $this->sendResponse($specialistArea->toArray(), 'SpecialistArea updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/specialistAreas/{id}",
     *      summary="Remove the specified SpecialistArea from storage",
     *      tags={"SpecialistArea"},
     *      description="Delete SpecialistArea",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistArea",
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
        /** @var SpecialistArea $specialistArea */
        $specialistArea = $this->specialistAreaRepository->find($id);

        if (empty($specialistArea)) {
            return $this->sendError('Specialist Area not found');
        }

        $specialistArea->delete();

        return $this->sendSuccess('Specialist Area deleted successfully');
    }
}
