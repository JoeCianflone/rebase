<?php

return [
    'views' => [
        'rebase' => [
            'pages' => env('PATH_VIEWS_REBASE_PAGES', 'Rebase/Pages'),
            'components' => env('PATH_VIEWS_REBASE_COMPONENTS', 'Rebase/Components'),
        ],

        'app' => [
            'pages' => env('PATH_VIEWS_APP_PAGES', 'App/Components'),
            'components' => env('PATH_VIEWS_APP_COMPONENTS', 'App/Components'),
        ],
    ],

    'view' => env('PATH_VIEWS', 'resources/js/Pages'),

    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),

    'models' => env('PATH_MODELS', 'app/Domain/Models'),

    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),

    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
