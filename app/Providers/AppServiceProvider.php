<?php

namespace App\Providers;

use Illuminate\Mail\MailManager;
use Illuminate\Mail\Transport\ResendTransport;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->get(MailManager::class)->extend('resend', function ($config) {
            return new ResendTransport(new \Resend\Client(env('RESEND_API_KEY')));
        });

        Paginator::useBootstrap();


        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }


    }
}
