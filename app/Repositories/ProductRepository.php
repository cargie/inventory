<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version September 6, 2017, 2:57 am UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
*/
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        'slug',
        'category_id',
        'category.name' => 'like',
        'description',
        'code' => 'like',
        'cost_price',
        'selling_price',
        'reorder_point',
        'opening_stock',
        'discount',
        'vat'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    public function getReorderableProducts()
    {
        return $this->model->whereColumn('available_quantity', '<', 'reorder_point');
    }
}
