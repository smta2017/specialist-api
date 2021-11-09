<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSliderImageAPIRequest;
use App\Http\Requests\API\UpdateSliderImageAPIRequest;
use App\Models\SliderImage;
use App\Repositories\SliderImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\SliderImageResource;
use Response;

/**
 * Class SliderImageController
 * @package App\Http\Controllers\API
 */

class SliderImageAPIController extends AppBaseController
{
    /** @var  SliderImageRepository */
    private $sliderImageRepository;

    public function __construct(SliderImageRepository $sliderImageRepo)
    {
        $this->sliderImageRepository = $sliderImageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sliderImages",
     *      summary="Get a listing of the SliderImages.",
     *      tags={"SliderImage"},
     *      description="Get all SliderImages",
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
     *                  @SWG\Items(ref="#/definitions/SliderImage")
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
        $sliderImages = $this->sliderImageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SliderImageResource::collection($sliderImages), 'Slider Images retrieved successfully');
    }

    /**
     * @param CreateSliderImageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sliderImages",
     *      summary="Store a newly created SliderImage in storage",
     *      tags={"SliderImage"},
     *      description="Store SliderImage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SliderImage that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SliderImage")
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
     *                  ref="#/definitions/SliderImage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSliderImageAPIRequest $request)
    {
        $input = $request->all();

        $sliderImage = $this->sliderImageRepository->create($input);

        return $this->sendResponse(new SliderImageResource($sliderImage), 'Slider Image saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sliderImages/{id}",
     *      summary="Display the specified SliderImage",
     *      tags={"SliderImage"},
     *      description="Get SliderImage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SliderImage",
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
     *                  ref="#/definitions/SliderImage"
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
        /** @var SliderImage $sliderImage */
        $sliderImage = $this->sliderImageRepository->find($id);

        if (empty($sliderImage)) {
            return $this->sendError('Slider Image not found');
        }

        return $this->sendResponse(new SliderImageResource($sliderImage), 'Slider Image retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSliderImageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sliderImages/{id}",
     *      summary="Update the specified SliderImage in storage",
     *      tags={"SliderImage"},
     *      description="Update SliderImage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SliderImage",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SliderImage that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SliderImage")
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
     *                  ref="#/definitions/SliderImage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSliderImageAPIRequest $request)
    {
        $input = $request->all();

        /** @var SliderImage $sliderImage */
        $sliderImage = $this->sliderImageRepository->find($id);

        if (empty($sliderImage)) {
            return $this->sendError('Slider Image not found');
        }

        $sliderImage = $this->sliderImageRepository->update($input, $id);

        return $this->sendResponse(new SliderImageResource($sliderImage), 'SliderImage updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sliderImages/{id}",
     *      summary="Remove the specified SliderImage from storage",
     *      tags={"SliderImage"},
     *      description="Delete SliderImage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SliderImage",
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
        /** @var SliderImage $sliderImage */
        $sliderImage = $this->sliderImageRepository->find($id);

        if (empty($sliderImage)) {
            return $this->sendError('Slider Image not found');
        }

        $sliderImage->delete();

        return $this->sendSuccess('Slider Image deleted successfully');
    }
}
