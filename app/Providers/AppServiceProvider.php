<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')
            || str_contains((string) config('app.url'), 'https://')
            || request()->server('HTTP_X_FORWARDED_PROTO') === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        app('url')->resolveMissingNamedRoutesUsing(function (string $name, array $parameters, bool $absolute) {
            return match ($name) {
                'sipintu.callback' => route('oauth.callback', $parameters, $absolute),
                'sipintu.redirect' => route('oauth.redirect', $parameters, $absolute),
                'oauth.callback' => route('sipintu.callback', $parameters, $absolute),
                'oauth.redirect' => route('sipintu.redirect', $parameters, $absolute),
                default => null,
            };
        });
    }
}
