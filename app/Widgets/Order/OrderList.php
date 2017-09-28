<?php

namespace App\Widgets\Order;

use App\Models\Order;
use Arrilot\Widgets\AbstractWidget;

class OrderList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $orders = Order::with(['customer'])->orderBy('ordered_at', 'desc')
            ->whereColumn('total_amount', '>', 'paid_amount')->limit(10)->get();

        return view('widgets.order.list', [
            'config' => $this->config,
            'orders' => $orders
        ]);
    }
}
