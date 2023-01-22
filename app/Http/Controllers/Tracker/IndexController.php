<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\Location;
use App\Models\Tracker\ProfessionalPlayerSession;
use App\Models\Tracker\ProfessionalSession;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function __invoke()
    {
        $locations = $this->getLocations();

        $locationRankings = $this->getLocationRankings($locations);

        $latestSessions = $this->getLatestSessions($locations);

        return view('tracker.index', [
            'locations' => $locations,
            'locationRankings' => $locationRankings,
            'latestSessions' => $latestSessions
        ]);
    }

    private function getLocations(): array
    {
        $cacheKey = 'tracking.index.locations';

        if ($locations = Cache::get($cacheKey)) {
            return $locations;
        }

        $locations = Location::query()
            ->with([
                'featured_image'
            ])
            ->get()
            ->mapWithKeys(static fn(Location $location): array => [
                $location->id => $location
            ])
            ->toArray();

        Cache::forever($cacheKey, $locations);

        return $locations;
    }

    private function getLocationRankings(array $locations): array
    {
        $rankings = [];

        foreach ($locations as $location) {
            $rankings[$location['id']] = [
                'highest' => $this->loadHighRankings($location),
                'lowest' => $this->loadLowRankings($location)
            ];
        }

        return $rankings;
    }

    private function loadHighRankings(array $location): array
    {
        $cacheKey = 'tracking.index.location.' . $location['id'] . '.rankings.highest';

        if ($rankings = Cache::get($cacheKey)) {
            return $rankings;
        }

        $rankings = $this->calculateLocationRankings($location, 'desc');

        Cache::forever($cacheKey, $rankings);

        return $rankings;
    }

    private function calculateLocationRankings(array $location, string $direction): array
    {
        $playerIds = ProfessionalPlayerSession::query()
            ->selectRaw('professional_player_id, SUM(net_winnings) as sum_net_winnings')
            ->groupBy('professional_player_id')
            ->orderBy('sum_net_winnings', $direction)
            ->join(
                'professional_sessions',
                'professional_player_sessions.professional_session_id',
                '=',
                'professional_sessions.id'
            )
            ->join(
                'professional_players',
                'professional_player_sessions.professional_player_id',
                '=',
                'professional_players.id'
            )
            ->where('professional_sessions.location_id', '=', $location['id'])
            ->where('professional_players.enabled', '=', 1)
            ->limit(5)
            ->pluck('professional_player_id');

        $results = ProfessionalPlayerSession::query()
            ->with([
                'professional_player'
            ])
            ->join(
                'professional_sessions',
                'professional_player_sessions.professional_session_id',
                '=',
                'professional_sessions.id'
            )
            ->where('professional_sessions.location_id', '=', $location['id'])
            ->whereIn('professional_player_id', $playerIds)
            ->lazy();

        $rankings = [];

        foreach ($results as $result) {
            if (!isset($rankings[$result->professional_player->name])) {
                $rankings[$result->professional_player->name] = [
                    'net_winnings' => 0,
                    'vpip' => 0,
                    'pfr' => 0,
                    'count' => 0
                ];
            }

            $rankings[$result->professional_player->name]['net_winnings'] += $result->net_winnings;
            $rankings[$result->professional_player->name]['vpip'] += $result->vpip;
            $rankings[$result->professional_player->name]['pfr'] += $result->pfr;
            $rankings[$result->professional_player->name]['count']++;
        }

        return collect($rankings)
            ->map(static fn(array $ranking) => [
                'net_winnings' => $ranking['net_winnings'],
                'vpip' => $ranking['vpip'] / $ranking['count'],
                'pfr' => $ranking['pfr'] / $ranking['count']
            ])
            ->sortBy(
                callback: 'net_winnings',
                descending: Str::lower($direction) === 'desc'
            )
            ->all();
    }

    private function loadLowRankings(array $location): array
    {
        $cacheKey = 'tracking.index.location.' . $location['id'] . '.rankings.lowest';

        if ($rankings = Cache::get($cacheKey)) {
            return $rankings;
        }

        $rankings = $this->calculateLocationRankings($location, 'asc');

        Cache::forever($cacheKey, $rankings);

        return $rankings;
    }

    private function getLatestSessions(array $locations): array
    {
        $cacheKey = 'tracking.index.latest-sessions';

        if ($sessions = Cache::get($cacheKey)) {
            return $sessions;
        }

        $sessions = ProfessionalSession::query()
            ->with([
                'stake',
                'poker_game',
                'players' => function ($query) {
                    $query->orderByDesc('net_winnings');
                }
            ])
            ->latest('date')
            ->limit(4)
            ->get()
            ->map(static fn(ProfessionalSession $session): ProfessionalSession => $session
                ->setRelation('location', new Location($locations[$session->location_id]))
            )
            ->toArray();

        Cache::forever($cacheKey, $sessions);

        return $sessions;
    }
}
