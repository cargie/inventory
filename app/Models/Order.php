<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version September 8, 2017, 8:16 am UTC
 *
 * @property integer customer_id
 * @property timestamp ordered_at
 * @property decimal total_amount
 * @property decimal paid_amount
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'ordered_at',
        'total_amount',
        'paid_amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required|exists:customers,id',
        'ordered_at' => 'date|required',
        'total_amount' => 'required|numeric|min:0',
        'paid_amount' => 'due_amount decimal,10,2:nullable number'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
