<?php

return [
    'views' => env('PATH_VIEWS', 'resources/js/Pages'),

    'controllers' => env('PATH_COONTROLLERS', 'app/Http/Controllers'),

    'models' => env('PATH_MODELS', 'app/Domain/Models'),

    'repositories' => env('PATH_REPOSITORIES', 'app/Domain/Repositories'),

    'nginx' => env('PATH_NGINX', '/etc/nginx'),
];
