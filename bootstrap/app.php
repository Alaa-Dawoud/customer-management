<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function() {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin' . '.')
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')
                ->prefix('employee')
                ->name('employee' . '.')
                ->namespace('App\Http\Controllers\Employee')
                ->group(base_path('routes/employee.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
