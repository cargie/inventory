<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\Models
 * @version September 6, 2017, 2:16 am UTC
 *
 * @property string name
 * @property string complete
 * @property integer province_id
 * @property integer city_id
 * @property string phone
 * @property string note
 */
class Address extends Model
{
    use SoftDeletes;

    public $table = 'addresses';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'complete',
        'province_id',
        'city_id',
        'phone',
        'note',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'complete' => 'string',
        'province_id' => 'integer',
        'city_id' => 'integer',
        'phone' => 'string',
        'note' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'complete' => 'required',
        'province_id' => 'required',
        'city_id' => 'required',
        'phone' => 'required',
        'note' => 'string',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
