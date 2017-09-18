<?php

namespace App\Http\Controllers;

use App\DataTables\StockAdjustmentDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateStockAdjustmentRequest;
use App\Http\Requests\UpdateStockAdjustmentRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StockAdjustmentRepository;
use Flash;
use Response;

class StockAdjustmentController extends AppBaseController
{
    /** @var  StockAdjustmentRepository */
    private $stockAdjustmentRepository;
    private $productRepository;

    public function __construct(StockAdjustmentRepository $stockAdjustmentRepo, ProductRepository $productRepo)
    {
        $this->stockAdjustmentRepository = $stockAdjustmentRepo;
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the StockAdjustment.
     *
     * @param StockAdjustmentDataTable $stockAdjustmentDataTable
     * @return Response
     */
    public function index(StockAdjustmentDataTable $stockAdjustmentDataTable)
    {
        return $stockAdjustmentDataTable->render('stock_adjustments.index');
    }

    /**
     * Show the form for creating a new StockAdjustment.
     *
     * @return Response
     */
    public function create()
    {
        $products = $this->productRepository->all();
        return view('stock_adjustments.create', compact('products'));
    }

    /**
     * Store a newly created StockAdjustment in storage.
     *
     * @param CreateStockAdjustmentRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentRequest $request)
    {
        $input = $request->all();

        $stockAdjustment = $this->stockAdjustmentRepository->create($input);

        Flash::success('Stock Adjustment saved successfully.');

        return redirect(route('stock-adjustments.index'));
    }

    /**
     * Display the specified StockAdjustment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            Flash::error('Stock Adjustment not found');

            return redirect(route('stock-adjustments.index'));
        }

        return view('stock_adjustments.show')->with('stockAdjustment', $stockAdjustment);
    }

    /**
     * Show the form for editing the specified StockAdjustment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            Flash::error('Stock Adjustment not found');

            return redirect(route('stock-adjustments.index'));
        }
        $products = $this->productRepository->all();
        return view('stock_adjustments.edit', compact('products'))->with('stockAdjustment', $stockAdjustment);
    }

    /**
     * Update the specified StockAdjustment in storage.
     *
     * @param  int              $id
     * @param UpdateStockAdjustmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentRequest $request)
    {
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            Flash::error('Stock Adjustment not found');

            return redirect(route('stock-adjustments.index'));
        }

        $stockAdjustment = $this->stockAdjustmentRepository->update($request->all(), $id);

        Flash::success('Stock Adjustment updated successfully.');

        return redirect(route('stock-adjustments.index'));
    }

    /**
     * Remove the specified StockAdjustment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockAdjustment = $this->stockAdjustmentRepository->findWithoutFail($id);

        if (empty($stockAdjustment)) {
            Flash::error('Stock Adjustment not found');

            return redirect(route('stock-adjustments.index'));
        }

        $this->stockAdjustmentRepository->delete($id);

        Flash::success('Stock Adjustment deleted successfully.');

        return redirect(route('stock-adjustments.index'));
    }
}
