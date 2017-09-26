<?php

namespace App\Repositories;

use App\Models\Setting;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class SettingRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SettingRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
