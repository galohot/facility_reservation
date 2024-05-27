<?php

use App\Http\Middleware\ForceHttps;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\VerificationStatus;
use App\Http\Middleware\VerifyManager;
use App\Http\Middleware\VerifyReservationOwnership;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'verify.reservation' => VerifyReservationOwnership::class,
            'verify.manager' => VerifyManager::class,
            'verify.status' => VerificationStatus::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();