<?php

namespace App\DataTables;

use App\Models\Supplier;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SupplierDataTable extends DataTable
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

        // $dataTable->addColumn('action', 'suppliers.datatables_actions');
        $dataTable->editColumn('is_active', function ($model) {
            if ($model->is_active) {
                return new HtmlString('<span class="label label-success">Active</span>');
            } else {
                return new HtmlString('<span class="label label-danger">Inactive</span>');
            }
        });
        $dataTable->editColumn('uid', function ($model) {
            return new HtmlString('<a href="' . route('suppliers.show', $model->uid) . '">' . $model->uid . '</a>');
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Supplier $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Supplier $model)
    {
        return $model->newQuery();
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
            'name',
            'email',
            'phone',
            'description',
            'is_active' => ['title' => 'Active'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'supplier_' . time();
    }
}
