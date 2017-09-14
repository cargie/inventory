<?php

namespace App\Repositories;

use App\Models\OrderProduct;

/**
 * Class OrderProductRepository
 * @package App\Repositories
 * @version September 8, 2017, 8:46 am UTC
 *
 * @method OrderProduct findWithoutFail($id, $columns = ['*'])
 * @method OrderProduct find($id, $columns = ['*'])
 * @method OrderProduct first($columns = ['*'])
*/
class OrderProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'amount',
        'discount',
        'var'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderProduct::class;
    }
}
