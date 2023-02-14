<?php

return [
    'token' => env('ANNUITIES_GENIUS_TOKEN'),

    'base_url' => env('ANNUITIES_GENIUS_BASE_URL', 'https://app.annuitiesgenius.com/api'),

    'cache' => [
        'enabled' => env('ANNUITIES_GENIUS_CACHE_ENABLED', false),
        'hours' => 24,
    ],
];
