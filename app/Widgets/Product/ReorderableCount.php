<?php

namespace App\Widgets\Product;

use App\Models\Product;
use Arrilot\Widgets\AbstractWidget;

class ReorderableCount extends AbstractWidget
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
        $count = Product::whereColumn('available_quantity', '<', 'reorder_point')->count();

        return view('widgets.product.reorderable_count', [
            'config' => $this->config,
            'count' => $count
        ]);
    }
}
