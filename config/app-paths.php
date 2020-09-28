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

    'db' => [
        'shared' => [
            'name' => env('DB_DATABASE', 'rebase_shared'),
            'connection' => env('DB_SHARED_CONNECTION_NAME', 'shared'),
            'migration_path' => env('DB_SHARED_MIGRATIONS', 'database/migrations'),
        ],
    
        'workspace' => [
            'name' => '',
            'prefix' => env('DB_WORKSPACE_PREFIX', 'rebase_'),
            'connection' => env('DB_WORKSPACE_CONNECTION_NAME', 'workspace'),
            'migration_path' => env('DB_WORKSPACE_MIGRATIONS', 'database/workspaces/migrations'),
        ],
    ],

    'workspace' => env('PATH_WORKSPACE', 'Workspace'),

    'view' => env('PATH_VIEWS', 'resources/js'),

    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),

    'models' => env('PATH_MODELS', 'app/Domain/Models'),

    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),

    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
