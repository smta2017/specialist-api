<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialTypeAPIRequest;
use App\Http\Requests\API\UpdateSpecialTypeAPIRequest;
use App\Models\SpecialType;
use App\Repositories\SpecialTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialTypeController
 * @package App\Http\Controllers\API
 */

class SpecialTypeAPIController extends AppBaseController
{
    /** @var  SpecialTypeRepository */
    private $SpecialTypeRepository;

    public function __construct(SpecialTypeRepository $SpecialTypeRepo)
    {
        $this->SpecialTypeRepository = $SpecialTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/SpecialType",
     *      summary="Get a listing of the SpecialType.",
     *      tags={"SpecialType"},
     *      description="Get all SpecialType",
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
     *                  @SWG\Items(ref="#/definitions/SpecialType")
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
        $SpecialType = $this->SpecialTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($SpecialType->toArray(), 'Special Types retrieved successfully');
    }

    /**
     * @param CreateSpecialTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/SpecialType",
     *      summary="Store a newly created SpecialType in storage",
     *      tags={"SpecialType"},
     *      description="Store SpecialType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialType")
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
     *                  ref="#/definitions/SpecialType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpecialTypeAPIRequest $request)
    {
        $input = $request->all();

        $SpecialType = $this->SpecialTypeRepository->create($input);

        return $this->sendResponse($SpecialType->toArray(), 'Special Types saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/SpecialType/{id}",
     *      summary="Display the specified SpecialType",
     *      tags={"SpecialType"},
     *      description="Get SpecialType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialType",
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
     *                  ref="#/definitions/SpecialType"
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
        /** @var SpecialType $SpecialType */
        $SpecialType = $this->SpecialTypeRepository->find($id);

        if (empty($SpecialType)) {
            return $this->sendError('Special Types not found');
        }

        return $this->sendResponse($SpecialType->toArray(), 'Special Types retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpecialTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/SpecialType/{id}",
     *      summary="Update the specified SpecialType in storage",
     *      tags={"SpecialType"},
     *      description="Update SpecialType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpecialType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpecialType")
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
     *                  ref="#/definitions/SpecialType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpecialTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialType $SpecialType */
        $SpecialType = $this->SpecialTypeRepository->find($id);

        if (empty($SpecialType)) {
            return $this->sendError('Special Types not found');
        }

        $SpecialType = $this->SpecialTypeRepository->update($input, $id);

        return $this->sendResponse($SpecialType->toArray(), 'SpecialType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/SpecialType/{id}",
     *      summary="Remove the specified SpecialType from storage",
     *      tags={"SpecialType"},
     *      description="Delete SpecialType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpecialType",
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
        /** @var SpecialType $SpecialType */
        $SpecialType = $this->SpecialTypeRepository->find($id);

        if (empty($SpecialType)) {
            return $this->sendError('Special Types not found');
        }

        $SpecialType->delete();

        return $this->sendSuccess('Special Types deleted successfully');
    }
}
