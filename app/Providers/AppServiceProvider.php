<?php

namespace App\Providers;

use App\Repositories\Tracker\PlayerRepository;
use App\Repositories\Tracker\SessionRepository;
use App\Support\AssetVersion;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Telescope::ignoreMigrations();

        $this->registerHelpers();
        $this->registerModelRepositories();
    }

    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());

        Filament::serving(static function () {
            Filament::registerViteTheme('resources/css/filament.css');

            Filament::registerNavigationGroups([
                'Tracker',
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
