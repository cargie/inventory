<?php

namespace App\Repositories;

use App\Models\StockAdjustmentProduct;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StockAdjustmentProductRepository
 * @package App\Repositories
 * @version September 18, 2017, 6:51 am UTC
 *
 * @method StockAdjustmentProduct findWithoutFail($id, $columns = ['*'])
 * @method StockAdjustmentProduct find($id, $columns = ['*'])
 * @method StockAdjustmentProduct first($columns = ['*'])
*/
class StockAdjustmentProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stock_adjustment_id',
        'product_id',
        'quantity'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StockAdjustmentProduct::class;
    }
}
