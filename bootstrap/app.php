<?php

use App\Http\Middleware\CheckMaintenanceMode;
use App\Http\Middleware\CheckPendingApplicant;
use App\Http\Middleware\EnsureTermsAccepted;
use App\Http\Middleware\ExcludeApiRoutesFromCsrf;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

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

            Route::middleware(['web', 'auth', 'role:student', 'update.last.seen'])
                ->prefix('student')
                ->as('student.')
                ->group(base_path(path: 'routes/student.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'csrf.except.api' => ExcludeApiRoutesFromCsrf::class,
            'check.maintenance' => CheckMaintenanceMode::class,
            'update.last.seen' => UpdateLastSeen::class,
            'terms.accepted' => EnsureTermsAccepted::class,
            'check.pending.applicant' => CheckPendingApplicant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
