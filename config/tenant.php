<?php

return [
    'shared' => env('DB_DATABASE', 'rebase_shared'),
    'shared_connection_name' => env('DB_SHARED_CONNECTION_NAME', 'shared'),
    'shared_migrations' => env('DB_SHARED_MIGRATIONS', 'database/shared/migrations'),

    'workspace_prefix' => env('DB_WORKSPACE_PREFIX', 'rebase'),
    'workspace_connection_name' => env('DB_WORKSPACE_CONNECTION_NAME', 'workspace'),
    'workspace_migrations' => env('DB_WORKSPACE_MIGRATIONS', 'database/workspaces/migrations'),
];
