<?php

return [
    'tmdb' => [
        'TMDB_CLAVE_API' => env('TMDB_CLAVE_API'),
        'TMDB_TOKEN' => env('TMDB_TOKEN'),
        'TMDB_URL' => env('TMDB_URL'),
        'trending' => [
            'all' => [
                'time_window_day' => 'day',
                'time_window_week' => 'week'
            ]
        ]
    ]
];
