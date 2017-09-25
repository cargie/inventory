<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;

class MetricsService
{

	private $orderRepository;
	private $productRepository;

	public function __construct(
		OrderRepository $orderRepo,
		ProductRepository $productRepo
	)
	{
		$this->orderRepository = $orderRepo;
		$this->productRepository = $productRepo;
	}

	public function total_revenue()
	{
		return $this->orderRepository->sum('paid_amount');
	}

	public function today_revenue()
	{
		return $this->orderRepository->findWhere([
			['created_at', '>', Carbon::today()],
		])->sum('paid_amount');
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