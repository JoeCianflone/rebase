<?php

return [
    'plan' => [
        'test' => env('STRIPE_PRODUCT_TEST'),
    ],
    'product' => [
        'test' => [
            'low' => [
                'id' => env('STRIPE_PRODUCT_ID_TEST_LOW'),
                'price' => env('STRIPE_PRODUCT_PRICE_TEST_LOW'),
            ],
            'medium' => [
                'id' => env('STRIPE_PRODUCT_ID_TEST_MEDIUM'),
                'price' => env('STRIPE_PRODUCT_PRICE_TEST_MEDIUM'),
            ],
            'high' => [
                'id' => env('STRIPE_PRODUCT_ID_TEST_HIGH'),
                'price' => env('STRIPE_PRODUCT_PRICE_TEST_HIGH'),
            ],
        ],
    ],
];
