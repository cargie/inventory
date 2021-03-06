<?php

namespace App\Repositories;

use App\Models\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version September 21, 2017, 8:11 am UTC
 *
 * @method Role findWithoutFail($id, $columns = ['*'])
 * @method Role find($id, $columns = ['*'])
 * @method Role first($columns = ['*'])
*/
class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }

    public function create(array $attributes)
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        return parent::create($attributes);
    }
}
