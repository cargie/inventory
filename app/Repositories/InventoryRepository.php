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
        'supplier_id',
        'supplied_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inventory::class;
    }
}
