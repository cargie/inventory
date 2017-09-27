<?php

return [
    //'default_namespace' => 'App\Widgets',

    'use_jquery_for_ajax_calls' => false,

    /*
    * Set Ajax widget middleware
    */
    'route_middleware' => [],

    /*
    * Relative path from the base directory to a regular widget stub.
    */
    'widget_stub'  => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget.stub',

    /*
    * Relative path from the base directory to a plain widget stub.
    */
    'widget_plain_stub'  => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget_plain.stub',

    'widgets' => [
        'Today Revenue' => App\Widgets\Revenue\Today::class,
        'Total Revenue' => App\Widgets\Revenue\Total::class,
        'Today Order'   => App\Widgets\Order\TodayOrder::class,
        'Product Reorderable Count' => App\Widgets\Product\ReorderableCount::class,
    ]
];
