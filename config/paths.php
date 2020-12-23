<?php

return [
    'namespaces' => [
        'rebase' => env('REBASE_NAMESPACE', 'rebase'),
        'appspace' => env('APP_NAMESPACE', 'appspace'),
    ],
    'subdomains' => [
        'admin' => env('ADMIN_SUBDOMAIN', 'my'),
        'auth' => env('AUTH_SUBDOMAIN', 'auth'),
    ],
    'views' => [
        'pages' => env('PATH_VIEW_PAGES', '/Pages'),
        'components' => env('PATH_VIEW_COMPONENTS', '/Components'),
        'templates' => env('PATH_VIEW_TEMPLATES', '/Templates'),
    ],
    'db' => [
        'migration_folder' => env('DB_MIGRATION_FOLDER', 'database/migrations'),
        'shared' => [
            'name' => env('DB_DATABASE', 'rebase_shared'),
            'connection' => env('DB_SHARED_CONNECTION_NAME', 'shared'),
            'migration_path' => env('DB_SHARED_MIGRATION_PATH', ''),
        ],
        'workspace' => [
            'name' => '',
            'prefix' => env('DB_WORKSPACE_PREFIX', 'rebase_'),
            'connection' => env('DB_WORKSPACE_CONNECTION_NAME', 'workspace'),
            'migration_path' => env('DB_WORKSPACE_MIGRATIONS', 'workspace'),
        ],
    ],
    'view' => env('PATH_VIEWS', 'resources/js'),
    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),
    'builders' => env('PATH_BUILDERS', 'app/Domain/Builders'),
    'collections' => env('PATH_COLLECTIONS', 'app/Domain/Collections'),
    'factories' => env('PATH_MODEL_FACTORIES', 'app/Domain/Factories'),
    'models' => env('PATH_MODELS', 'app/Domain/Models'),
    'traits' => env('PATH_TRAITS', 'app/Domain/Traits'),
    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
