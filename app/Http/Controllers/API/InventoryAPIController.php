<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInventoryAPIRequest;
use App\Http\Requests\API\UpdateInventoryAPIRequest;
use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InventoryController
 * @package App\Http\Controllers\API
 */

class InventoryAPIController extends AppBaseController
{
    /** @var  InventoryRepository */
    private $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepo)
    {
        $this->inventoryRepository = $inventoryRepo;
    }

    /**
     * Display a listing of the Inventory.
     * GET|HEAD /inventories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inventoryRepository->pushCriteria(new RequestCriteria($request));
        $inventories = $this->inventoryRepository->paginate(request()->get('limit', 10));

        return $this->sendResponse($inventories->toArray(), 'Inventories retrieved successfully');
    }

    /**
     * Store a newly created Inventory in storage.
     * POST /inventories
     *
     * @param CreateInventoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryAPIRequest $request)
    {
        $input = $request->all();

        $inventories = $this->inventoryRepository->create($input);

        return $this->sendResponse($inventories->toArray(), 'Inventory saved successfully');
    }

    /**
     * Display the specified Inventory.
     * GET|HEAD /inventories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        return $this->sendResponse($inventory->toArray(), 'Inventory retrieved successfully');
    }

    /**
     * Update the specified Inventory in storage.
     * PUT/PATCH /inventories/{id}
     *
     * @param  int $id
     * @param UpdateInventoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        $inventory = $this->inventoryRepository->update($input, $id);

        return $this->sendResponse($inventory->toArray(), 'Inventory updated successfully');
    }

    /**
     * Remove the specified Inventory from storage.
     * DELETE /inventories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Inventory $inventory */
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            return $this->sendError('Inventory not found');
        }

        $inventory->delete();

        return $this->sendResponse($id, 'Inventory deleted successfully');
    }
}
