<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockAdjustmentProduct
 * @package App\Models
 * @version September 18, 2017, 6:51 am UTC
 *
 * @property integer stock_adjustment_id
 * @property integer product_id
 * @property integer quantity
 */
class StockAdjustmentProduct extends Model
{
    use SoftDeletes;

    public $table = 'stock_adjustment_products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'stock_adjustment_id',
        'product_id',
        'quantity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'stock_adjustment_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'exists:products,id|required',
        'quantity' => 'numeric|required'
    ];

    
}
