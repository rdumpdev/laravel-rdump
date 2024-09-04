<?php

return [
    'url' => env('RDUMP_URL', 'https://rdump.dev/api/dump'),
    'private_key' => env('RDUMP_PRIVATE_KEY'),
    'enabled' => env('RDUMP_ENABLED', true),
];
