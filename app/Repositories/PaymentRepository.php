<?php

namespace App\Repositories;

use App\Models\Payment;
use Carbon\Carbon;

/**
 * Class PaymentRepository
 * @package App\Repositories
 * @version September 8, 2017, 8:21 am UTC
 *
 * @method Payment findWithoutFail($id, $columns = ['*'])
 * @method Payment find($id, $columns = ['*'])
 * @method Payment first($columns = ['*'])
*/
class PaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'paid_at',
        'amount',
        'mode'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Payment::class;
    }

    public function create(array $attributes)
    {
        $attributes['paid_at'] = Carbon::now();

        $model = parent::create($attributes);

        $order = $model->refresh()->order;

        $order->increment('paid_amount', $model->amount);

        return $model;
    }
}
