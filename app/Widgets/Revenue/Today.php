<?php

namespace App\Widgets\Revenue;

use App\Models\Payment;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class Today extends AbstractWidget
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
        $revenue = Payment::where([
            ['created_at', '>', Carbon::today()],
        ])->sum('amount');

        return view('widgets.revenue.today', [
            'config' => $this->config,
            'revenue' => $revenue
        ]);
    }
}
