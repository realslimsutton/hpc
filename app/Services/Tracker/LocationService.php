<?php

namespace App\Services\Tracker;

use App\Models\Tracker\Location;
use App\Models\Tracker\PlayerSession;
use App\Models\Tracker\Session;
use App\Services\BaseService;

class LocationService extends BaseService
{
    public function __construct(
        string $cachePrefix = 'tracker.locations',
        int $cacheTtl = 86400
    )
    {
        parent::__construct($cachePrefix, $cacheTtl);
    }

    public function getLocations(int $limit = 3)
    {
        return $this->cache(
            'index',
            static fn() => Location::query()
                ->with([
                    'featured_image'
                ])
                ->limit($limit)
                ->get()
        );
    }

    public function getLocationRankings(Location $location, int $limit = 5): array
    {
        return $this->cache(
            $location->id . '.rankings',
            fn(): array => [
                'high' => $this->calculateLocationRankings($location, 'desc', $limit),
                'low' => $this->calculateLocationRankings($location, 'asc', $limit),
            ]
        );
    }

    private function calculateLocationRankings(Location $location, string $direction, int $limit): array
    {
        return PlayerSession::query()
            ->select([
                'player_session.player_id AS player_id',
                'players.name AS player_name'
            ])
            ->selectRaw('SUM(player_session.net_winnings) as sum_net_winnings')
            ->selectRaw('AVG(player_session.vpip) as avg_vpip')
            ->selectRaw('AVG(player_session.pfr) as avg_pfr')
            ->selectRaw('SUM(player_session.hours_played) as sum_hours_played')
            ->groupBy('player_session.player_id')
            ->orderBy('sum_net_winnings', $direction)
            ->join(
                'sessions',
                'player_session.session_id',
                '=',
                'sessions.id'
            )
            ->join(
                'players',
                'player_session.player_id',
                '=',
                'players.id'
            )
            ->where('players.enabled', '=', 1)
            ->where('sessions.location_id', '=', $location->id)
            ->limit($limit)
            ->get()
            ->mapWithKeys(static fn(PlayerSession $playerSession): array => [
                $playerSession->player_id => $playerSession->only([
                    'player_name',
                    'sum_net_winnings',
                    'avg_vpip',
                    'avg_pfr',
                    'sum_hours_played',
                ]),
            ])
            ->all();
    }
}
