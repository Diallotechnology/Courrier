<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Rate Limiters
    |--------------------------------------------------------------------------
    |
    | Here you may define your rate limiters and their configurations. The
    | name of each rate limiter should correspond to a "limiter" name
    | returned by the "rateLimiter" method of the application.
    |
    */

    'default' => [
        'limit' => env('RATE_LIMITER_DEFAULT_LIMIT', 60),
        'expires_in' => env('RATE_LIMITER_DEFAULT_EXPIRES', 1),
    ],

    // Add additional rate limiters as needed

];
