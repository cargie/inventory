<?php

namespace App\Repositories;

use App\Models\Inventory;

/**
 * Class InventoryRepository
 * @package App\Repositories
 * @version September 6, 2017, 6:32 am UTC
 *
 * @method Inventory findWithoutFail($id, $columns = ['*'])
 * @method Inventory find($id, $columns = ['*'])
 * @method Inventory first($columns = ['*'])
*/
class InventoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'supplier.name' => 'like',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inventory::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        if($model->has('products')) {
            foreach ($model->products as $product) {
                $product->increment('available_quantity', $product->pivot->quantity);
            }
        }

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $old = $this->model->with(['products'])->findOrFail($id);

        $update = parent::update($attributes, $id);

        foreach ($old->products as $product) {
            $product->decrement('available_quantity', $product->pivot->quantity);
        }

        foreach ($update->products as $product) {
            $product->increment('available_quantity', $product->pivot->quantity);
        }

        return $update;
    }
}
