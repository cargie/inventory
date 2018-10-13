<?php

namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version September 8, 2017, 8:16 am UTC
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'ordered_at',
        'total_amount',
        'paid_amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        if (isset($attributes['paid_amount']) && $attributes['paid_amount'] > 0) {
            if ($attributes['paid_amount'] >= $attributes['total_amount']) {
                $payment = $model->payments()->create([
                    'paid_at' => Carbon::now(),
                    'amount' => $attributes['paid_amount'],
                    'mode' => $attributes['payment_mode'],
                    'note' => $attributes['payment_note'],
                ]);
            } else {
                $payment = $model->payments()->create([
                    'paid_at' => Carbon::now(),
                    'amount' => $attributes['paid_amount'],
                    'mode' => $attributes['payment_mode'],
                    'note' => $attributes['payment_note'],
                ]);
            }

            $payment->save();

            $order = $model;
            $order->paid_amount = $attributes['paid_amount'];
            $order->save();
        }

        $model->products->map(function ($p) {
            $p->decrement('available_quantity', $p->pivot->quantity);
        });

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $old = $this->model->with(['products'])->where('uid', $id)->firstOrFail();

        $update = parent::update($attributes, $old->id);

        foreach ($old->products as $product) {
            $product->increment('available_quantity', $product->pivot->quantity);
        }

        foreach ($update->products as $product) {
            $product->decrement('available_quantity', $product->pivot->quantity);
        }

        return $update;
    }

    public function getAllUnPaid($columns = ['*'])
    {
        $model = $this->model->whereColumn('total_amount', '>', 'paid_amount')->get($columns);

        return $this->parserResult($model);
    }
}
