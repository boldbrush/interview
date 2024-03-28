<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
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
        Date::use(CarbonImmutable::class);

        $this->globalHttpClientConfiguration();
    }

    private function globalHttpClientConfiguration(): void
    {
        Http::globalOptions([
            'timeout' => 3.0,
            'connect_timeout' => 1.0,
        ]);

        Event::listen(CommandStarting::class, function (CommandStarting $event) {
            if ($event->command == 'db:seed') {
                // override defaults when seeding database
                Http::globalOptions([
                    'timeout' => 10,
                    'connect_timeout' => 1.0,
                ]);
            }
        });
    }
}
