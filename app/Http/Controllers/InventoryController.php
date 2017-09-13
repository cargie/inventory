<?php

namespace App\Http\Controllers;

use App\DataTables\InventoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Repositories\InventoryRepository;
use App\Repositories\SupplierRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InventoryController extends AppBaseController
{
    /** @var  InventoryRepository */
    private $inventoryRepository;
    private $supplierRepository;

    public function __construct(InventoryRepository $inventoryRepo, SupplierRepository $supplierRepo)
    {
        $this->inventoryRepository = $inventoryRepo;
        $this->supplierRepository = $supplierRepo;
    }

    /**
     * Display a listing of the Inventory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(InventoryDataTable $inventoryDataTable)
    {
        // $this->inventoryRepository->pushCriteria(new RequestCriteria($request));
        // $inventories = $this->inventoryRepository->all();

        // return view('inventories.index')
        //     ->with('inventories', $inventories);
        
        return $inventoryDataTable->render('inventories.index');
    }

    /**
     * Show the form for creating a new Inventory.
     *
     * @return Response
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->all();
        return view('inventories.create', compact('suppliers'));
    }

    /**
     * Store a newly created Inventory in storage.
     *
     * @param CreateInventoryRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryRequest $request)
    {
        $input = $request->all();

        $inventory = $this->inventoryRepository->create($input);

        Flash::success('Inventory saved successfully.');

        return redirect(route('inventories.index'));
    }

    /**
     * Display the specified Inventory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        return view('inventories.show')->with('inventory', $inventory);
    }

    /**
     * Show the form for editing the specified Inventory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventory = $this->inventoryRepository
            ->with(['products.category'])
            ->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        $suppliers = $this->supplierRepository->all();
        return view('inventories.edit', compact('suppliers', 'inventory'));
    }

    /**
     * Update the specified Inventory in storage.
     *
     * @param  int              $id
     * @param UpdateInventoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryRequest $request)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        $inventory = $this->inventoryRepository->update($request->all(), $id);

        Flash::success('Inventory updated successfully.');

        return redirect(route('inventories.index'));
    }

    /**
     * Remove the specified Inventory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        $this->inventoryRepository->delete($id);

        Flash::success('Inventory deleted successfully.');

        return redirect(route('inventories.index'));
    }
}
