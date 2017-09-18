<?php

namespace App\Http\Controllers;

use App\DataTables\StockAdjustmentProductDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockAdjustmentProductRequest;
use App\Http\Requests\UpdateStockAdjustmentProductRequest;
use App\Repositories\StockAdjustmentProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StockAdjustmentProductController extends AppBaseController
{
    /** @var  StockAdjustmentProductRepository */
    private $stockAdjustmentProductRepository;

    public function __construct(StockAdjustmentProductRepository $stockAdjustmentProductRepo)
    {
        $this->stockAdjustmentProductRepository = $stockAdjustmentProductRepo;
    }

    /**
     * Display a listing of the StockAdjustmentProduct.
     *
     * @param StockAdjustmentProductDataTable $stockAdjustmentProductDataTable
     * @return Response
     */
    public function index(StockAdjustmentProductDataTable $stockAdjustmentProductDataTable)
    {
        return $stockAdjustmentProductDataTable->render('stock_adjustment_products.index');
    }

    /**
     * Show the form for creating a new StockAdjustmentProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_adjustment_products.create');
    }

    /**
     * Store a newly created StockAdjustmentProduct in storage.
     *
     * @param CreateStockAdjustmentProductRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentProductRequest $request)
    {
        $input = $request->all();

        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->create($input);

        Flash::success('Stock Adjustment Product saved successfully.');

        return redirect(route('stockAdjustmentProducts.index'));
    }

    /**
     * Display the specified StockAdjustmentProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            Flash::error('Stock Adjustment Product not found');

            return redirect(route('stockAdjustmentProducts.index'));
        }

        return view('stock_adjustment_products.show')->with('stockAdjustmentProduct', $stockAdjustmentProduct);
    }

    /**
     * Show the form for editing the specified StockAdjustmentProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            Flash::error('Stock Adjustment Product not found');

            return redirect(route('stockAdjustmentProducts.index'));
        }

        return view('stock_adjustment_products.edit')->with('stockAdjustmentProduct', $stockAdjustmentProduct);
    }

    /**
     * Update the specified StockAdjustmentProduct in storage.
     *
     * @param  int              $id
     * @param UpdateStockAdjustmentProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentProductRequest $request)
    {
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            Flash::error('Stock Adjustment Product not found');

            return redirect(route('stockAdjustmentProducts.index'));
        }

        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->update($request->all(), $id);

        Flash::success('Stock Adjustment Product updated successfully.');

        return redirect(route('stockAdjustmentProducts.index'));
    }

    /**
     * Remove the specified StockAdjustmentProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockAdjustmentProduct = $this->stockAdjustmentProductRepository->findWithoutFail($id);

        if (empty($stockAdjustmentProduct)) {
            Flash::error('Stock Adjustment Product not found');

            return redirect(route('stockAdjustmentProducts.index'));
        }

        $this->stockAdjustmentProductRepository->delete($id);

        Flash::success('Stock Adjustment Product deleted successfully.');

        return redirect(route('stockAdjustmentProducts.index'));
    }
}
