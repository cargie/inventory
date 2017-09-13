<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Supplier
 * @package App\Models
 * @version September 5, 2017, 9:05 am UTC
 *
 * @property string name
 * @property string email
 * @property string phone
 * @property string description
 * @property boolean is_active
 */
class Supplier extends Model
{
    use SoftDeletes;

    public $table = 'suppliers';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'email',
        'phone',
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'description' => 'string',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function products()
    {
        return $this->hasManyThrough(InventoryProduct::class, Inventory::class);
    }
}
