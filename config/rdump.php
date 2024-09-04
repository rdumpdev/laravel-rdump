<?php

return [
    'url' => env('RDUMP_URL', 'https://rdump.dev/api/dump'),
    'private_key' => env('RDUMP_PRIVATE_KEY'),
    'timeout' => 4,
    'enabled' => env('RDUMP_ENABLED', true),
    'report_errors' => env('RDUMP_ERROR_REPORTING', false),
];
