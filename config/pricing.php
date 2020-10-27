<?php

return [
    'plan' => [
        'test' => env('STRIPE_PRODUCT_TEST'),
    ],
    'product' => [
        'test' => [
            'low' => [
                'name' => env('STRIPE_PRODUCT_TEST_LOW_NAME'),
                'id' => env('STRIPE_PRODUCT_TEST_LOW_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_LOW_COST'),
            ],
            'medium' => [
                'name' => env('STRIPE_PRODUCT_TEST_MEDIUM_NAME'),
                'id' => env('STRIPE_PRODUCT_TEST_MEDIUM_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_MEDIUM_COST'),
            ],
            'high' => [
                'name' => env('STRIPE_PRODUCT_TEST_HIGH_NAME'),
                'id' => env('STRIPE_PRODUCT_TEST_HIGH_ID'),
                'price' => env('STRIPE_PRODUCT_TEST_HIGH_COST'),
            ],
        ],
    ],
];
