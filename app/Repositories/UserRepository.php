<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Password;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version September 19, 2017, 2:53 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'uid',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function create(array $attributes)
    {

        $model = parent::create($attributes);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        if ($attributes['password'] == null) {
            unset($attributes['password']);
        }

        $model = parent::updateBy($attributes, 'uid' , $id);

        return $model;
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
