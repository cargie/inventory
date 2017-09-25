<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class MetricsService
{

	private $orderRepository;
	private $productRepository;
	private $paymentRepository;

	public function __construct(
		OrderRepository $orderRepo,
		ProductRepository $productRepo,
		PaymentRepository $paymentRepo
	)
	{
		$this->orderRepository = $orderRepo;
		$this->productRepository = $productRepo;
		$this->paymentRepository = $paymentRepo;
	}

	public function total_revenue()
	{
		return $this->paymentRepository->sum('amount');
	}

	public function today_revenue()
	{
		return $this->paymentRepository->findWhere([
			['created_at', '>', Carbon::today()],
		])->sum('amount');
	}

	public function avg_revenue()
	{
		return number_format($this->orderRepository->avg('paid_amount'), 2);
	}

	public function orders_today()
	{
		return $this->orderRepository->findWhere([
			['created_at', '>', Carbon::today()]
		])->count();
	}

	public function reorderable_products()
	{
		return $this->productRepository->getReorderableProducts()->count();
	}
}