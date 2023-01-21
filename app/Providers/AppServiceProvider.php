<?php

namespace App\Providers;

use App\Services\AssetVersion;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AssetVersion::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Filament::serving(static function () {
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups([
                'System',
            ]);
        });
    }
}
