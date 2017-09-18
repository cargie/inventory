<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @version September 8, 2017, 8:21 am UTC
 *
 * @property integer order_id
 * @property timestamp paid_at
 * @property decimal amount
 * @property string mode
 */
class Payment extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'payments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'paid_at',
        'amount',
        'mode',
        'note',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'mode' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order' => 'required|exists:orders,id',
        // 'paid_at' => 'date|required',
        'amount' => 'required|numeric|min:0',
        'mode' => 'required|in:cash,cheque,credit,debit',
        'note' => 'nullable'
    ];

    public function sluggable()
    {
        return [
            'uid' => [
                'source' => 'id',
                'unique' => true,
                'separator' => '-',
                'onUpdate' => true,
                'method' => function ($string, $separator) {
                    return 'PAY' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
