<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockAdjustment
 * @package App\Models
 * @version September 18, 2017, 6:43 am UTC
 *
 * @property string uid
 * @property string reason
 */
class StockAdjustment extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'stock_adjustments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'reason',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'uid' => 'string',
        'reason' => 'string',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'uid' => 'nullable',
        'reason' => 'required|string',
        'products' => 'required'
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
                    return 'SA' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'stock_adjustment_products')
            ->withPivot(['quantity']);
    }
}
