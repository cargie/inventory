<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Inventory
 * @package App\Models
 * @version September 6, 2017, 6:32 am UTC
 *
 * @property integer supplier_id
 * @property timestamp supplied_at
 */
class Inventory extends Model
{
    use SoftDeletes;

    public $table = 'inventories';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'supplier_id',
        'supplied_at',
        'total_amount',
        'paid_amount',
        'due_amount',
        'notes',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'supplier_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'supplier_id' => 'required|exists:suppliers,id',
        'supplied_at' => 'date',
        'products' => 'required|array',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'inventory_products')
            ->withPivot('quantity','price_per_unit', 'total_amount', 'sold_quantity');
    }
}
