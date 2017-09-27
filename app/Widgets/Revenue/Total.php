<?php

namespace App\Widgets\Revenue;

use App\Models\Payment;
use Arrilot\Widgets\AbstractWidget;

class Total extends AbstractWidget
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
        //
        $total_revenue = Payment::sum('amount');

        return view('widgets.revenue.total', [
            'config' => $this->config,
            'total_revenue' => $total_revenue
        ]);
    }
}
