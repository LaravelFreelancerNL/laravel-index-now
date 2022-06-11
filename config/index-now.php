<?php

declare(strict_types=1);

return [
    'host' => env('APP_URL', 'localhost'),
    'key' => env('INDEXNOW_KEY', ''),
    'key-location' => env('INDEXNOW_KEY_LOCATION', ''),
    'search-engine' => env('INDEXNOW_SEARCH_ENGINE', 'api.indexnow.org'),
    'delay' => env('INDEXNOW_SUBMIT_DELAY', 600),
];
