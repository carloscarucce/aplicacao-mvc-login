<?php

use \App\Http\Middleware;

return [
    /*
     * Middlewares
     */
    'middleware' => [
        'auth' => Middleware\AuthMiddleware::class,
        'log' => Middleware\LogMiddleware::class,
        'csrf' => Middleware\CsrfTokenMiddleware::class,
    ],

    /*
     * Application providers
     */
    'providers' => [
        \App\Auth\AuthProvider::class,
        \App\Provider\RequestProvider::class,
        \App\Provider\RoutingProvider::class,
        \App\Provider\SessionProvider::class,
        \App\Provider\AppProvider::class,
    ],
];
