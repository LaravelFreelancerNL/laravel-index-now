<?php

declare(strict_types=1);

return [
    'delay' => env('INDEXNOW_SUBMIT_DELAY', 600),
    'host' => env('APP_URL', 'localhost'),
    'key' => env('INDEXNOW_KEY', ''),
    'key-location' => env('INDEXNOW_KEY_LOCATION', ''),
    'log-failed-submits' => env('INDEXNOW_LOG_FAILED_SUBMITS', true),
    'production-env' => env('INDEXNOW_PRODUCTION_ENV', 'production'),
    'search-engine' => env('INDEXNOW_SEARCH_ENGINE', 'api.indexnow.org'),
];
