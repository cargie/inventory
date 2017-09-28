<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Iatstuti\Database\Support\CascadeSoftDeletes;
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
    use SoftDeletes, CascadeSoftDeletes, Sluggable;

    public $table = 'orders';
    

    protected $dates = ['deleted_at', 'ordered_at'];

    protected $cascadeDeletes = ['payments'];

    public $fillable = [
        'customer_id',
        'ordered_at',
        'total_amount',
        'mode',
    ];

    protected $appends = ['due_amount'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'customer_id' => 'integer',
        'total_amount' => 'float',
        'paid_amount' => 'float',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer' => 'required|exists:customers,id',
        'ordered_at' => 'date|required',
        'total_amount' => 'required|numeric|min:0',
        'paid_amount' => 'numeric|nullable',
        'products' => 'required|array'
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
                    return 'OR' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['quantity', 'price', 'amount', 'discount', 'vat']);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function getDueAmountAttribute()
    {
        return (float)number_format($this->total_amount - $this->paid_amount, 2 , '.' , '');
    }

    public function setOrderedAtAttribute($value)
    {
        $this->attributes['ordered_at'] = Carbon::parse($value);
    }
}
