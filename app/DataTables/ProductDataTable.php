<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
        // $dataTable->addColumn('action', 'products.datatables_actions');
        $dataTable->addColumn('category', function ($model) {
            return optional($model->category)->name;
        });
        $dataTable->addColumn('quantity', function ($model) {
            return $model->inventories->sum('pivot.quantity');
        });
        $dataTable->editColumn('uid', function ($model) {
            return new HtmlString('<a href="' . route('products.show' , $model->uid) . '">' . $model->uid . '</a>');
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->with(['category'])->select(['products.*']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->addAction(['width' => '80px'])
                    ->parameters([
                        'stateSave' => true,
                        'dom'     => 'Bfrtip',
                        'order'   => [[0, 'desc']],
                        'buttons' => [
                            'export',
                            'print',
                            'reset',
                            'reload',
                            'colvis'
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'uid' => ['title' => 'ID'],
            'code',
            'name' => ['name' => 'name', 'data' => 'name'],
            'category' => ['name' => 'category.name', 'data' => 'category'],
            'cost_price',
            'selling_price',
            'available_quantity' => ['title' => 'Available Qty.'],
            'reorder_point',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'product_' . time();
    }
}
