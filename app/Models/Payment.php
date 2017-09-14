<?php

namespace App\Models;

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
    use SoftDeletes;

    public $table = 'payments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_id',
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
        'order_id' => 'required|exists:orders,id',
        'paid_at' => 'date|required',
        'amount' => 'required|numeric|min:0',
        'mode' => 'required|in:cash,cheque,credit,debit',
        'note' => 'nullable'
    ];

    
}
