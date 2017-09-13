<?php

namespace App\Repositories;

use App\Models\Supplier;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SupplierRepository
 * @package App\Repositories
 * @version September 5, 2017, 9:05 am UTC
 *
 * @method Supplier findWithoutFail($id, $columns = ['*'])
 * @method Supplier find($id, $columns = ['*'])
 * @method Supplier first($columns = ['*'])
*/
class SupplierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'description',
        'is_active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Supplier::class;
    }
}
