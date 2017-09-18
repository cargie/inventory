<?php

namespace App\DataTables;

use App\Models\StockAdjustmentProduct;
use Form;
use Yajra\Datatables\Services\DataTable;

class StockAdjustmentProductDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'stock_adjustment_products.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $stockAdjustmentProducts = StockAdjustmentProduct::query();

        return $this->applyScopes($stockAdjustmentProducts);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'stock_adjustment_id' => ['name' => 'stock_adjustment_id', 'data' => 'stock_adjustment_id'],
            'product_id' => ['name' => 'product_id', 'data' => 'product_id'],
            'quantity' => ['name' => 'quantity', 'data' => 'quantity']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stockAdjustmentProducts';
    }
}
