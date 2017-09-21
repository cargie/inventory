<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version September 8, 2017, 2:49 am UTC
 *
 * @property string name
 * @property string slug
 * @property string description
 * @property integer parent_id
 */
class Category extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        // 'slug',
        'description',
        'parent_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'parent_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        // 'slug' => 'required|unique:categories,slug',
        'description' => 'string|nullable',
        'parent' => 'exists:categories,id|nullable',
    ];

    /**
     * Validation custom message
     *
     * @var array
     */
    public static $messages = [
        'parent_id.exists' => 'The selected parent is invalid.'
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
                    return 'CA' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function children()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }
}
