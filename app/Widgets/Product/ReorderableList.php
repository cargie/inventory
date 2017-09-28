<?php

namespace App\Widgets\Product;

use App\Models\Product;
use Arrilot\Widgets\AbstractWidget;

class ReorderableList extends AbstractWidget
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
        $products  = Product::with(['category'])->whereColumn('reorder_point', '>', 'available_quantity')->limit(10)->get();

        return view('widgets.product.reorderable_list', [
            'config' => $this->config,
            'products' => $products,
        ]);
    }
}
