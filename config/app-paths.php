<?php

return [
    'views' => env('PATH_VIEWS', 'resources/js/Pages'),

    'view_shared_pages' => env('PATH_SHARED_PAGES', 'Shared/Pages'),

    'view_shared_components' => env('PATH_SHARED_COMPONENTS', 'Shared/Components'),

    'view_app_pages' => env('PATH_APP_PAGES', 'App/Pages'),

    'view_app_components' => env('PATH_APP_COMPONENTS', 'App/Components'),

    'controllers' => env('PATH_CONTROLLERS', 'app/Http/Controllers'),

    'models' => env('PATH_MODELS', 'app/Domain/Models'),

    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),

    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
