<?php

use Roots\Acorn\Application;
use Roots\Acorn\Configuration\Exceptions;
use Roots\Acorn\Configuration\Middleware;

add_action(
    'after_setup_theme',
    function () {
        Application::configure()
            ->withProviders()
            ->withMiddleware(function (Middleware $middleware): void {
                //
            })
            ->withExceptions(function (Exceptions $exceptions): void {
                //
            })
            ->withRouting(web: base_path('routes/web.php'))
            ->boot();
    },
    0,
);
