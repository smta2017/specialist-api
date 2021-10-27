<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialistPlanAPIRequest;
use App\Http\Requests\API\UpdateSpecialistPlanAPIRequest;
use App\Models\SpecialistPlan;
use App\Repositories\SpecialistPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialistPlanController
 * @package App\Http\Controllers\API
 */

class SpecialistPlanAPIController extends AppBaseController
{
    /** @var  SpecialistPlanRepository */
    private $specialistPlanRepository;

    public function __construct(SpecialistPlanRepository $specialistPlanRepo)
    {
        $this->specialistPlanRepository = $specialistPlanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistPlans",
     *      summary="Get a listing of the SpecialistPlans.",
     *      tags={"SpecialistPlan"},
     *      description="Get all SpecialistPlans",
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
     *                  @SWG\Items(ref="#/definitions/SpecialistPlan")
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
        $specialistPlans = $this->specialistPlanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialistPlans->toArray(), 'Specialist Plans retrieved successfully');
    }

    /**
     * @param CreateSpecialistPlanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/specialistPlans",
     *      summary="Store a newly created SpecialistPlan in storage",
     *      tags={"SpecialistPlan"},
     *      description="Store SpecialistPlan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistPlan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistPlan")
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
     *                  ref="#/definitions/SpecialistPlan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpecialistPlanAPIRequest $request)
    {
        $input = $request->all();

        $specialistPlan = $this->specialistPlanRepository->create($input);

        return $this->sendResponse($specialistPlan->toArray(), 'Specialist Plan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/specialistPlans/{id}",
     *      summary="Display the specified SpecialistPlan",
     *      tags={"SpecialistPlan"},
     *      description="Get SpecialistPlan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistPlan",
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
     *                  ref="#/definitions/SpecialistPlan"
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
        /** @var SpecialistPlan $specialistPlan */
        $specialistPlan = $this->specialistPlanRepository->find($id);

        if (empty($specialistPlan)) {
            return $this->sendError('Specialist Plan not found');
        }

        return $this->sendResponse($specialistPlan->toArray(), 'Specialist Plan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpecialistPlanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/specialistPlans/{id}",
     *      summary="Update the specified SpecialistPlan in storage",
     *      tags={"SpecialistPlan"},
     *      description="Update SpecialistPlan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistPlan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialistPlan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialistPlan")
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
     *                  ref="#/definitions/SpecialistPlan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpecialistPlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialistPlan $specialistPlan */
        $specialistPlan = $this->specialistPlanRepository->find($id);

        if (empty($specialistPlan)) {
            return $this->sendError('Specialist Plan not found');
        }

        $specialistPlan = $this->specialistPlanRepository->update($input, $id);

        return $this->sendResponse($specialistPlan->toArray(), 'SpecialistPlan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/specialistPlans/{id}",
     *      summary="Remove the specified SpecialistPlan from storage",
     *      tags={"SpecialistPlan"},
     *      description="Delete SpecialistPlan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialistPlan",
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
        /** @var SpecialistPlan $specialistPlan */
        $specialistPlan = $this->specialistPlanRepository->find($id);

        if (empty($specialistPlan)) {
            return $this->sendError('Specialist Plan not found');
        }

        $specialistPlan->delete();

        return $this->sendSuccess('Specialist Plan deleted successfully');
    }
}
