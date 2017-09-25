<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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

        // $dataTable->addColumn('action', 'categories.datatables_actions');
        $dataTable->addColumn('parent', function ($model) {
            return optional($model->parent)->name;
        });
        $dataTable->editColumn('uid', function ($model) {
            return new HtmlString('<a href="' . route('categories.show', $model->uid) . '">' . $model->uid . '</a>');
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AppModels\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->newQuery()->with(['parent'])->select(['categories.*']);
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
            'parent' => ['data' => 'parent', 'name' => 'parent.name', 'orderable' => false, 'searchable' => false],
            'description'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'category_' . time();
    }
}
