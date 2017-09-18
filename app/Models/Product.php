<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version September 6, 2017, 2:57 am UTC
 *
 * @property string name
 * @property string slug
 * @property integer category_id
 * @property string description
 * @property string code
 * @property decimal cost_price
 * @property decimal selling_price
 * @property integer reorder_point
 * @property integer opening_stock
 * @property decimal discount
 * @property decimal vat
 */
class Product extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'products';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'code',
        'cost_price',
        'selling_price',
        'reorder_point',
        'opening_stock',
        'discount',
        'vat',
        'attribute'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'category_id' => 'integer',
        'description' => 'string',
        'code' => 'string',
        'reorder_point' => 'integer',
        'opening_stock' => 'integer',
        'attribute' => 'object',
        'available_quantity' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'category' => 'exists:categories,id|required',
        'description' => 'string|nullable',
        'code' => 'required|unique:products,code',
        'cost_price' => 'numeric|required|min:0',
        'selling_price' => 'required|numeric|min:0',
        'reorder_point' => 'numeric|required|min:0',
        'opening_stock' => 'numeric|required|min:1',
        'discount' => 'numeric|nullable|min:0',
        'vat' => 'numeric|nullable|min:0',
        'attribute' => 'array',
        'available_quantity' => 'nullable|numeric',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => true,
            ],
            'uid' => [
                'source' => 'id',
                'unique' => true,
                'separator' => '-',
                'onUpdate' => true,
                'method' => function ($string, $separator) {
                    return 'PR' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->withTrashed();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'inventory_products')
            ->withPivot('quantity','price_per_unit', 'total_amount', 'sold_quantity');
    }
}
