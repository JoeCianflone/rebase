<?php

return [
    'views' => [
        'rebase' => [
            'pages' => env('PATH_VIEWS_REBASE_PAGES', 'Rebase/Pages'),
            'components' => env('PATH_VIEWS_REBASE_COMPONENTS', 'Rebase/Components'),
        ],

        'app' => [
            'pages' => env('PATH_VIEWS_APP_PAGES', 'App/Pages'),
            'components' => env('PATH_VIEWS_APP_COMPONENTS', 'App/Components'),
        ],
    ],

    'shared' => env('PATH_SHARED', 'Shared'),

    'workspace' => env('PATH_WORKSPACE', 'Workspace'),

    'view' => env('PATH_VIEWS', 'resources/js'),

    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),

    'models' => env('PATH_MODELS', 'app/Domain/Models'),

    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),

    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
