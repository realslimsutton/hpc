<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Tracker\GameRule;
use App\Models\Tracker\Location;
use App\Models\Tracker\Player;
use App\Models\Tracker\Session;
use App\Models\Tracker\Stake;
use App\Policies\MediaPolicy;
use App\Policies\RolePolicy;
use App\Policies\Tracker\GameRulePolicy;
use App\Policies\Tracker\LocationPolicy;
use App\Policies\Tracker\PlayerPolicy;
use App\Policies\Tracker\SessionPolicy;
use App\Policies\Tracker\StakePolicy;
use Awcodes\Curator\Models\Media;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Media::class => MediaPolicy::class,

        Player::class => PlayerPolicy::class,
        Location::class => LocationPolicy::class,
        Stake::class => StakePolicy::class,
        GameRule::class => GameRulePolicy::class,
        Session::class => SessionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
