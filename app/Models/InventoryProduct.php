<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InventoryProduct
 * @package App\Models
 * @version September 8, 2017, 7:11 am UTC
 *
 * @property integer inventory_id
 * @property integer product_id
 * @property integer quantity
 * @property decimal price_per_unit
 * @property decimal total_amount
 * @property integer sold_quantity
 */
class InventoryProduct extends Model
{
    use SoftDeletes;

    public $table = 'inventory_products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'inventory_id',
        'product_id',
        'quantity',
        'price_per_unit',
        'total_amount',
        'sold_quantity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'inventory_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer',
        'sold_quantity' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'inventory_id' => 'required|exists:inventories,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1',
        'price_per_unit' => 'required|numeric|min:0',
        'total_amount' => 'required|numeric|min:0',
        'sold_quantity' => 'numeric|min:0|nullable'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withTrashed();
    }
}
