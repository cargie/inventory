<?php

namespace App\Repositories;

use App\Models\InventoryProduct;

/**
 * Class InventoryProductRepository
 * @package App\Repositories
 * @version September 8, 2017, 7:11 am UTC
 *
 * @method InventoryProduct findWithoutFail($id, $columns = ['*'])
 * @method InventoryProduct find($id, $columns = ['*'])
 * @method InventoryProduct first($columns = ['*'])
*/
class InventoryProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inventory_id',
        'product_id',
        'quantity',
        'price_per_unit',
        'total_amount',
        'sold_quantity'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InventoryProduct::class;
    }
}
