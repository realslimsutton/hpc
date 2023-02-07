<?php

namespace App\Providers;

use App\Support\AssetVersion;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerHelpers();
        $this->registerModelRepositories();
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());

        Filament::serving(static function () {
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups([
                'Club',
                'Tracker',
                'Loyalty Program',
                'System',
            ]);
        });
    }

    private function registerHelpers(): void
    {
        $this->app->singleton(AssetVersion::class);
    }

    private function registerModelRepositories(): void
    {
        $this->app->singleton(SessionRepository::class);
    }
}
