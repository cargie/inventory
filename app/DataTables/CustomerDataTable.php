<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
        // $dataTable->addColumn('action', 'customers.datatables_actions');
        $dataTable->addColumn('name', function ($model) {
            return $model->first_name . ' ' . $model->last_name;
        });
        $dataTable->editColumn('uid', function ($model) {
            return new HtmlString('<a href="' . route('customers.show', $model->uid) . '">' . $model->uid . '</a>');
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
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
                            'colvis',
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
            'name' => ['name' => 'first_name'],
            'last_name' => ['visible' => false],
            'first_name' => ['visible' => false],
            'phone',
            'email'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'customer_' . time();
    }
}
