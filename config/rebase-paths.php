<?php

return [
    'admin_subdomain' => env('ADMIN_SUBDOMAIN', 'my'),
    'views' => [
        'pages' => env('PATH_VIEW_PAGES', '/Pages'),
        'components' => env('PATH_VIEW_COMPONENTS', '/Components'),
        'templates' => env('PATH_VIEW_TEMPLATES', '/Templates'),
        'rebase' => env('PATH_VIEW_REBASE', '/Rebase'),
        'app' => env('PATH_VIEW_PAGES', '/App'),
    ],

    'db' => [
        'shared' => [
            'name' => env('DB_DATABASE', 'rebase_shared'),
            'connection' => env('DB_SHARED_CONNECTION_NAME', 'shared'),
            'migration_path' => env('DB_SHARED_MIGRATIONS', 'database/migrations'),
            'rebase_migration_path' => env('DB_REBASE_SHARED_MIGRATIONS', 'database/migrations/rebase'),
        ],
        'workspace' => [
            'name' => '',
            'prefix' => env('DB_WORKSPACE_PREFIX', 'rebase_'),
            'connection' => env('DB_WORKSPACE_CONNECTION_NAME', 'workspace'),
            'migration_path' => env('DB_WORKSPACE_MIGRATIONS', 'database/migrations/workspace'),
            'rebase_migration_path' => env('DB_REBASE_WORKSPACE_MIGRATIONS', 'database/migrations/rebase/workspace'),
        ],
    ],

    'workspace' => env('PATH_WORKSPACE', 'Workspace'),
    'view' => env('PATH_VIEWS', 'resources/js'),
    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),
    'models' => env('PATH_MODELS', 'app/Domain/Models'),
    'facades' => env('PATH_FACADES', 'app/Domain/Facades'),
    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),
    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
