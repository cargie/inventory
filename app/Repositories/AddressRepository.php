<?php

namespace App\Repositories;

use App\Models\Address;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version September 6, 2017, 2:16 am UTC
 *
 * @method Address findWithoutFail($id, $columns = ['*'])
 * @method Address find($id, $columns = ['*'])
 * @method Address first($columns = ['*'])
*/
class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'complete',
        'province_id',
        'city_id',
        'phone',
        'note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Address::class;
    }
}
