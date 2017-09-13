<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderProductAPIRequest;
use App\Http\Requests\API\UpdateOrderProductAPIRequest;
use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OrderProductController
 * @package App\Http\Controllers\API
 */

class OrderProductAPIController extends AppBaseController
{
    /** @var  OrderProductRepository */
    private $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepo)
    {
        $this->orderProductRepository = $orderProductRepo;
    }

    /**
     * Display a listing of the OrderProduct.
     * GET|HEAD /orderProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderProductRepository->pushCriteria(new RequestCriteria($request));
        $this->orderProductRepository->pushCriteria(new LimitOffsetCriteria($request));
        $orderProducts = $this->orderProductRepository->all();

        return $this->sendResponse($orderProducts->toArray(), 'Order Products retrieved successfully');
    }

    /**
     * Store a newly created OrderProduct in storage.
     * POST /orderProducts
     *
     * @param CreateOrderProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProductAPIRequest $request)
    {
        $input = $request->all();

        $orderProducts = $this->orderProductRepository->create($input);

        return $this->sendResponse($orderProducts->toArray(), 'Order Product saved successfully');
    }

    /**
     * Display the specified OrderProduct.
     * GET|HEAD /orderProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->findWithoutFail($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        return $this->sendResponse($orderProduct->toArray(), 'Order Product retrieved successfully');
    }

    /**
     * Update the specified OrderProduct in storage.
     * PUT/PATCH /orderProducts/{id}
     *
     * @param  int $id
     * @param UpdateOrderProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->findWithoutFail($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct = $this->orderProductRepository->update($input, $id);

        return $this->sendResponse($orderProduct->toArray(), 'OrderProduct updated successfully');
    }

    /**
     * Remove the specified OrderProduct from storage.
     * DELETE /orderProducts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->findWithoutFail($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct->delete();

        return $this->sendResponse($id, 'Order Product deleted successfully');
    }
}
