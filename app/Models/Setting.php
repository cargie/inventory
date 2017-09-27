<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{

    protected $fillable = [
    	'key', 'value'
    ];

    protected $casts = [
    	'key' => 'string',
        'value' => 'array'
    ];

    public static function boot()
    {
    	static::saved(function () {

			Cache::forget('view-settings-variable');
    	});
    }
}
