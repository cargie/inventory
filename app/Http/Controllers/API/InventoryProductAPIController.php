<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventoryProductAPIRequest;
use App\Http\Requests\API\UpdateInventoryProductAPIRequest;
use App\Models\InventoryProduct;
use App\Repositories\InventoryProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InventoryProductController
 * @package App\Http\Controllers\API
 */

class InventoryProductAPIController extends AppBaseController
{
    /** @var  InventoryProductRepository */
    private $inventoryProductRepository;

    public function __construct(InventoryProductRepository $inventoryProductRepo)
    {
        $this->inventoryProductRepository = $inventoryProductRepo;
    }

    /**
     * Display a listing of the InventoryProduct.
     * GET|HEAD /inventoryProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inventoryProductRepository->pushCriteria(new RequestCriteria($request));
        $inventoryProducts = $this->inventoryProductRepository->paginate(request()->get('limit', 10));

        return $this->sendResponse($inventoryProducts->toArray(), 'Inventory Products retrieved successfully');
    }

    /**
     * Store a newly created InventoryProduct in storage.
     * POST /inventoryProducts
     *
     * @param CreateInventoryProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryProductAPIRequest $request)
    {
        $input = $request->all();

        $inventoryProducts = $this->inventoryProductRepository->create($input);

        return $this->sendResponse($inventoryProducts->toArray(), 'Inventory Product saved successfully');
    }

    /**
     * Display the specified InventoryProduct.
     * GET|HEAD /inventoryProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var InventoryProduct $inventoryProduct */
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            return $this->sendError('Inventory Product not found');
        }

        return $this->sendResponse($inventoryProduct->toArray(), 'Inventory Product retrieved successfully');
    }

    /**
     * Update the specified InventoryProduct in storage.
     * PUT/PATCH /inventoryProducts/{id}
     *
     * @param  int $id
     * @param UpdateInventoryProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var InventoryProduct $inventoryProduct */
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            return $this->sendError('Inventory Product not found');
        }

        $inventoryProduct = $this->inventoryProductRepository->update($input, $id);

        return $this->sendResponse($inventoryProduct->toArray(), 'InventoryProduct updated successfully');
    }

    /**
     * Remove the specified InventoryProduct from storage.
     * DELETE /inventoryProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var InventoryProduct $inventoryProduct */
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            return $this->sendError('Inventory Product not found');
        }

        $inventoryProduct->delete();

        return $this->sendResponse($id, 'Inventory Product deleted successfully');
    }
}
