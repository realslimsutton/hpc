<?php

namespace App\Services\Tracker;

use App\Models\Tracker\Session;
use App\Services\BaseService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SessionService extends BaseService
{
    public function __construct(
        string $cachePrefix = 'tracker.sessions',
        int    $cacheTtl = 86400
    )
    {
        parent::__construct($cachePrefix, $cacheTtl);
    }

    public function getLatestSessions(int $limit = 4): Collection
    {
        return $this->cache(
            'latest.' . $limit,
            static fn() => Session::query()
                ->with([
                    'location',
                    'game_rules',
                    'stake',
                    'players' => static function (Builder $query) {
                        $query->orderByDesc('player_session.net_winnings');
                    },
                ])
                ->latest('date')
                ->limit($limit)
                ->get()
        );
    }

    public function getFacts(Collection $sessions): array
    {
        return [
            'sum_net_winnings' => $sessions->sum('pivot.net_winnings'),
            'avg_vpip' => $sessions->avg('pivot.vpip'),
            'avg_pfr' => $sessions->avg('pivot.pfr'),
            'avg_hourly_net_winnings' => $sessions->avg(static fn(Session $session) => $session->pivot->hours_played > 0
                ? $session->pivot->net_winnings / $session->pivot->hours_played
                : null
            ),
            'avg_hourly_bb' => $sessions->avg(static fn(Session $session) => ($session->pivot->hours_played > 0 && $session->stake->big_blind > 0)
                ? ($session->pivot->net_winnings / $session->stake->big_blind) / $session->pivot->hours_played
                : null
            ),
            'sum_hours_played' => $sessions->sum('pivot.hours_played'),
            'sessions_count' => $sessions->count(),
            'first_session_date' => $sessions->first()?->date,
            'most_played_stake' => $sessions
                ->groupBy('stake.name')
                ->map(static fn(Collection $sessions): int => $sessions->count())
                ->sort()
                ->keys()
                ->last(),
        ];
    }

    public function getBreakdownByLocation(Collection $sessions): Collection
    {
        return $sessions
            ->mapToGroups(static fn(Session $session): array => [
                $session->location->name => $session,
            ])
            ->map(fn(Collection $sessions): array => $this->getFacts($sessions));
    }

    public function getHistoricalChart(Collection $sessions): array
    {
        $data = $sessions->filter(static fn(Session $session): bool => filled($session->pivot->net_winnings));

        return [
            'series' => $data
                ->map(static fn(Session $session): array => [
                    'date' => $session->date,
                    'net_winnings' => $session->pivot->net_winnings / 100,
                    'location' => $session->location->name,
                    'game_rules' => $session->game_rules->name,
                    'stake' => $session->stake->name,
                ])
                ->sortBy('date')
                ->all(),

            'filters' => [
                'locations' => $data
                    ->pluck('location.name')
                    ->unique()
                    ->sort(),

                'gameRules' => $data
                    ->pluck('game_rules.name')
                    ->unique()
                    ->sort(),

                'stakes' => $data
                    ->sortBy(['stake.small_blind', 'stake.big_blind'])
                    ->pluck('stake.name')
                    ->unique(),

                'minYear' => $data
                    ->min(static fn(Session $session) => $session->date->year),
            ],
        ];
    }
}
