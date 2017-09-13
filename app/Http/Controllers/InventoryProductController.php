<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventoryProductRequest;
use App\Http\Requests\UpdateInventoryProductRequest;
use App\Repositories\InventoryProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InventoryProductController extends AppBaseController
{
    /** @var  InventoryProductRepository */
    private $inventoryProductRepository;

    public function __construct(InventoryProductRepository $inventoryProductRepo)
    {
        $this->inventoryProductRepository = $inventoryProductRepo;
    }

    /**
     * Display a listing of the InventoryProduct.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inventoryProductRepository->pushCriteria(new RequestCriteria($request));
        $inventoryProducts = $this->inventoryProductRepository->all();

        return view('inventory_products.index')
            ->with('inventoryProducts', $inventoryProducts);
    }

    /**
     * Show the form for creating a new InventoryProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory_products.create');
    }

    /**
     * Store a newly created InventoryProduct in storage.
     *
     * @param CreateInventoryProductRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryProductRequest $request)
    {
        $input = $request->all();

        $inventoryProduct = $this->inventoryProductRepository->create($input);

        Flash::success('Inventory Product saved successfully.');

        return redirect(route('inventoryProducts.index'));
    }

    /**
     * Display the specified InventoryProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            Flash::error('Inventory Product not found');

            return redirect(route('inventoryProducts.index'));
        }

        return view('inventory_products.show')->with('inventoryProduct', $inventoryProduct);
    }

    /**
     * Show the form for editing the specified InventoryProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            Flash::error('Inventory Product not found');

            return redirect(route('inventoryProducts.index'));
        }

        return view('inventory_products.edit')->with('inventoryProduct', $inventoryProduct);
    }

    /**
     * Update the specified InventoryProduct in storage.
     *
     * @param  int              $id
     * @param UpdateInventoryProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryProductRequest $request)
    {
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            Flash::error('Inventory Product not found');

            return redirect(route('inventoryProducts.index'));
        }

        $inventoryProduct = $this->inventoryProductRepository->update($request->all(), $id);

        Flash::success('Inventory Product updated successfully.');

        return redirect(route('inventoryProducts.index'));
    }

    /**
     * Remove the specified InventoryProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventoryProduct = $this->inventoryProductRepository->findWithoutFail($id);

        if (empty($inventoryProduct)) {
            Flash::error('Inventory Product not found');

            return redirect(route('inventoryProducts.index'));
        }

        $this->inventoryProductRepository->delete($id);

        Flash::success('Inventory Product deleted successfully.');

        return redirect(route('inventoryProducts.index'));
    }
}
