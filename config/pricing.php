<?php

return [
    'plan' => [
        'test' => env('STRIPE_PRODUCT_TEST'),
    ],
    'product' => [
        'test' => [
            'low' => [
                'name' => 'Awesome Product 1',
                'id' => env('STRIPE_PRODUCT_TEST_LOW_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_LOW_COST'),
            ],
            'medium' => [
                'name' => 'Awesome Product 2',
                'id' => env('STRIPE_PRODUCT_TEST_MEDIUM_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_MEDIUM_COST'),
            ],
            'high' => [
                'name' => 'Awesome Product 3',
                'id' => env('STRIPE_PRODUCT_TEST_HIGH_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_HIGH_COST'),
            ],
        ],
    ],
];
