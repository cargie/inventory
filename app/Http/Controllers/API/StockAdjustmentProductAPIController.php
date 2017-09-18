<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockAdjustmentProductAPIRequest;
use App\Http\Requests\API\UpdateStockAdjustmentProductAPIRequest;
use App\Models\StockAdjustmentProduct;
use App\Repositories\StockAdjustmentProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StockAdjustmentProductController
 * @package App\Http\Controllers\API
 */

class StockAdjustmentProductAPIController extends AppBaseController
{
    /** @var  StockAdjustmentProductRepository */
    private $stockAdjustmentProductRepository;

    public function __construct(StockAdjustmentProductRepository $stockAdjustmentProductRepo)
    {
        $this->stockAdjustmentProductRepository = $stockAdjustmentProductRepo;
    }

    /**
     * Display a listing of the StockAdjustmentProduct.
     * GET|HEAD /stockAdjustmentProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stockAdjustmentProductRepository->pushCriteria(new RequestCriteria($request));
        $this->stockAdjustmentProductRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stockAdjustmentProducts = $this->stockAdjustmentProductRepository->all();

        return $this->sendResponse($stockAdjustmentProducts->toArray(), 'Stock Adjustment Products retrieved successfully');
    }

    /**
     * Store a newly created StockAdjustmentProduct in storage.
     * POST /stockAdjustmentProducts
     *
     * @param CreateStockAdjustmentProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentProductAPIRequest $request)
    {
        $input = $request->all();

        $stockAdjustmentProducts = $this->stockAdjustmentProductRepository->create($input);

        return $this->sendResponse($stockAdjustmentProducts->toArray(), 'Stock Adjustment Product saved successfully');
    }

    /**
     * Display the specified StockAdjustmentProduct.
     * GET|HEAD /stockAdjustmentProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var StockAdjustmentProduct $stockAdjustmentProduct */
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            return $this->sendError('Stock Adjustment Product not found');
        }

        return $this->sendResponse($stockAdjustmentProduct->toArray(), 'Stock Adjustment Product retrieved successfully');
    }

    /**
     * Update the specified StockAdjustmentProduct in storage.
     * PUT/PATCH /stockAdjustmentProducts/{id}
     *
     * @param  int $id
     * @param UpdateStockAdjustmentProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockAdjustmentProduct $stockAdjustmentProduct */
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            return $this->sendError('Stock Adjustment Product not found');
        }

        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->update($input, $id);

        return $this->sendResponse($stockAdjustmentProduct->toArray(), 'StockAdjustmentProduct updated successfully');
    }

    /**
     * Remove the specified StockAdjustmentProduct from storage.
     * DELETE /stockAdjustmentProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var StockAdjustmentProduct $stockAdjustmentProduct */
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            return $this->sendError('Stock Adjustment Product not found');
        }

        $stockAdjustmentProduct->delete();

        return $this->sendResponse($id, 'Stock Adjustment Product deleted successfully');
    }
}
