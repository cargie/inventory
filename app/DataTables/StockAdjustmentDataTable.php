<?php

namespace App\DataTables;

use App\Models\StockAdjustment;
use Form;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class StockAdjustmentDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        // $dataTable->addColumn('action', 'stock_adjustments.datatables_actions');
        $dataTable->addColumn('total_quantity', function ($model) {
            return $model->products->sum('pivot.quantity');
        });

        return $dataTable;
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $stockAdjustments = StockAdjustment::query();

        return $this->applyScopes($stockAdjustments);
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
            // ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'export',
                    'print',
                    'reset',
                    'reload',
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
            'uid' => ['title' => 'ID'],
            'reason' => ['name' => 'reason', 'data' => 'reason'],
            'note' => ['name' => 'note', 'data' => 'note'],
            'total_quantity' => ['searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stockAdjustments';
    }
}
