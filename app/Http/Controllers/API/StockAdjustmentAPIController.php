<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockAdjustmentAPIRequest;
use App\Http\Requests\API\UpdateStockAdjustmentAPIRequest;
use App\Models\StockAdjustment;
use App\Repositories\StockAdjustmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StockAdjustmentController
 * @package App\Http\Controllers\API
 */

class StockAdjustmentAPIController extends AppBaseController
{
    /** @var  StockAdjustmentRepository */
    private $stockAdjustmentRepository;

    public function __construct(StockAdjustmentRepository $stockAdjustmentRepo)
    {
        $this->stockAdjustmentRepository = $stockAdjustmentRepo;
    }

    /**
     * Display a listing of the StockAdjustment.
     * GET|HEAD /stockAdjustments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stockAdjustmentRepository->pushCriteria(new RequestCriteria($request));
        $this->stockAdjustmentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stockAdjustments = $this->stockAdjustmentRepository->all();

        return $this->sendResponse($stockAdjustments->toArray(), 'Stock Adjustments retrieved successfully');
    }

    /**
     * Store a newly created StockAdjustment in storage.
     * POST /stockAdjustments
     *
     * @param CreateStockAdjustmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentAPIRequest $request)
    {
        $input = $request->all();

        $stockAdjustments = $this->stockAdjustmentRepository->create($input);

        return $this->sendResponse($stockAdjustments->toArray(), 'Stock Adjustment saved successfully');
    }

    /**
     * Display the specified StockAdjustment.
     * GET|HEAD /stockAdjustments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        return $this->sendResponse($stockAdjustment->toArray(), 'Stock Adjustment retrieved successfully');
    }

    /**
     * Update the specified StockAdjustment in storage.
     * PUT/PATCH /stockAdjustments/{id}
     *
     * @param  int $id
     * @param UpdateStockAdjustmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        $stockAdjustment = $this->stockAdjustmentRepository->update($input, $id);

        return $this->sendResponse($stockAdjustment->toArray(), 'StockAdjustment updated successfully');
    }

    /**
     * Remove the specified StockAdjustment from storage.
     * DELETE /stockAdjustments/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        $stockAdjustment->delete();

        return $this->sendResponse($id, 'Stock Adjustment deleted successfully');
    }
}
