<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Models
 * @version September 5, 2017, 7:43 am UTC
 *
 * @property string name
 * @property string slug
 * @property string description
 */
class Tag extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'tags';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'slug',
        'description',
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
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'slug' => 'unique:tags,slug',
        'description' => 'string',
    ];

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'taggable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'unique' => true,
            ]
        ];
    }
}
