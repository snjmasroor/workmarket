<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            // Wrap all routes that depend on sessions/auth/errors/etc. in `web` middleware
            Route::middleware('web')->group(function () {
                require base_path('routes/web.php');
                require base_path('routes/admin.php');
            });

            // Console routes (do not need web middleware)
            require base_path('routes/console.php');

            // Channels route if needed (optional)
            // require base_path('routes/channels.php');
        },
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user-access' => \App\Http\Middleware\UserAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
