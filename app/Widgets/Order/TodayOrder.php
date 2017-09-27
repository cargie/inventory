<?php

namespace App\Widgets\Order;

use App\Models\Order;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class TodayOrder extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'class' => 'col-sm-4'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Order::where('created_at', '>', Carbon::today())->count();

        return view('widgets.order.today_count', [
            'config' => $this->config,
            'count' => $count
        ]);
    }
}
