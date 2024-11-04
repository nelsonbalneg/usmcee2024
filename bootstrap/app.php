<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\ExcludeApiRoutesFromCsrf;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'auth', 'role:admin'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth', 'role:utdc'])
                ->prefix('utdc')
                ->as('utdc.')
                ->group(base_path('routes/utdc.php'));

            Route::middleware(['web', 'auth', 'role:student'])
                ->prefix('student')
                ->as('student.')
                ->group(base_path(path: 'routes/student.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'csrf.except.api' => ExcludeApiRoutesFromCsrf::class, // Register the CSRF exclusion middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
