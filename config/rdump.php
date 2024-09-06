<?php

return [
    'url' => env('RDUMP_URL', 'https://rdump.dev/api/dump'),
    'private_key' => env('RDUMP_PRIVATE_KEY'),
    'enabled' => env('RDUMP_ENABLED', true),
    'error_reporting_enabled' => env('RDUMP_ERROR_REPORTING_ENABLED', false),
    'error_reporting_groups' => env('RDUMP_ERROR_REPORTING_GROUPS', ['web', 'api']),
];
