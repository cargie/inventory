<?php

namespace App\Repositories;

use App\Models\StockAdjustment;

/**
 * Class StockAdjustmentRepository
 * @package App\Repositories
 * @version September 18, 2017, 6:43 am UTC
 *
 * @method StockAdjustment findWithoutFail($id, $columns = ['*'])
 * @method StockAdjustment find($id, $columns = ['*'])
 * @method StockAdjustment first($columns = ['*'])
*/
class StockAdjustmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uid',
        'reason'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StockAdjustment::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        if ($model->has('products')) {
            foreach ($model->products as $product) {
                $product->increment('available_quantity', $product->pivot->quantity);
            }
        }

        return $model;
    }
}
