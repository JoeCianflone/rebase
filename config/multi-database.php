<?php

return [
    'shared' => [
        'name' => env('DB_DATABASE', 'rebase_shared'),
        'connection' => env('DB_SHARED_CONNECTION_NAME', 'shared'),
        'migration_path' => env('DB_SHARED_MIGRATIONS', 'database/shared/migrations'),
    ],

    'workspace' => [
        'name' => '',
        'prefix' => env('DB_WORKSPACE_PREFIX', 'rebase_'),
        'connection' => env('DB_WORKSPACE_CONNECTION_NAME', 'workspace'),
        'migration_path' => env('DB_WORKSPACE_MIGRATIONS', 'database/workspaces/migrations'),
    ],
];
