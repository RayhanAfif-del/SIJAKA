<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->is('panel-sijaka')) {
                if (Auth::guard('mitra')->check()) {
                    return route('mitra.dashboard');
                }
                return route('alumni.dashboard');
            }

            if ($request->is('pane-admin-sijaka') || $request->is('panel-admin-sijaka')) {
                return route('admin.dashboard');
            }

            return match (true) {
                Auth::guard('admin')->check() => route('admin.dashboard'),
                Auth::guard('mitra')->check() => route('mitra.dashboard'),
                Auth::guard('alumni')->check() => route('alumni.dashboard'),
                default => route('home'),
            };
        });

        $middleware->redirectGuestsTo(function (Request $request) {
            return $request->is('admin') || $request->is('admin/*')
                ? route('admin.login')
                : route('login');
        });

        $middleware->validateCsrfTokens(except: [
            'api/*',
            'health',
            'sipintu/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
