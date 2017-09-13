<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OrderProduct
 * @package App\Models
 * @version September 8, 2017, 8:46 am UTC
 *
 * @property integer order_id
 * @property integer product_id
 * @property integer quantity
 * @property decimal price
 * @property decimal amount
 * @property decimal discount
 * @property decimal vat
 */
class OrderProduct extends Model
{
    use SoftDeletes;

    public $table = 'order_products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'amount',
        'discount',
        'vat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|exists:orders,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1',
        'price' => 'required|numeric|min:0',
        'amount' => 'numeric|nullable',
        'discount' => 'numeric|nullable',
        'vat' => 'numeric|nullable'
    ];

    
}
