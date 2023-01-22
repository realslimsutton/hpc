<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\Location;
use App\Models\Tracker\ProfessionalSession;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function __invoke()
    {
        $locations = Location::query()
            ->with([
                'featured_image'
            ])
            ->get()
            ->mapWithKeys(static fn(Location $location): array => [
                $location->id => $location
            ]);

        $locationRankings = $this->getLocationRankings($locations);

        $latestSessions = ProfessionalSession::query()
            ->with([
                'stake',
                'poker_game',
                'players'
            ])
            ->latest('date')
            ->limit(4)
            ->get()
            ->map(static fn(ProfessionalSession $session): ProfessionalSession => $session
                ->setRelation('location', $locations[$session->location_id])
            );

        return view('tracker.index', [
            'locations' => $locations,
            'locationRankings' => $locationRankings,
            'latestSessions' => $latestSessions
        ]);
    }

    private function getLocationRankings(Collection $locations): array
    {
        $locationRankings = collect($this->getCumulativeTotals($locations))
            ->map(static fn(array $rankings) => [
                'highest' => collect($rankings)
                    ->sortByDesc('net_winnings')
                    ->take(5)
                    ->all(),
                'lowest' => collect($rankings)
                    ->sortBy('net_winnings')
                    ->take(5)
                    ->all()
            ]);

        return $locationRankings->all();
    }

    private function getCumulativeTotals(Collection $locations): array
    {
        $totals = [];

        foreach ($locations as $location) {
            $cacheKey = 'tracker.location.' . $location->id . '.rankings';

            if (!$rankings = null) {
                $rankings = $this->calculateLocationRankings($location);

                Cache::forever($cacheKey, $rankings);
            }

            $totals[$location->id] = $rankings;
        }

        return $totals;
    }

    private function calculateLocationRankings(Location $location): array
    {
        $rankings = [];

        $sessions = $location->professional_sessions()
            ->with([
                'players'
            ])
            ->lazy();

        foreach ($sessions as $session) {
            foreach ($session->players as $player) {
                if (!$player->enabled) {
                    continue;
                }

                if (!isset($rankings->player->name)) {
                    $rankings[$player->name] = [
                        'net_winnings' => 0,
                        'vpip' => 0,
                        'pfr' => 0,
                        'session_count' => 0
                    ];
                }

                $rankings[$player->name]['net_winnings'] += $player->pivot->net_winnings;
                $rankings[$player->name]['vpip'] += $player->pivot->vpip;
                $rankings[$player->name]['pfr'] += $player->pivot->pfr;
                $rankings[$player->name]['session_count']++;
            }
        }

        foreach ($rankings as $player) {
            $sessionCount = $player['session_count'];
            if ($sessionCount === 0) {
                continue;
            }

            $player['vpip'] /= $sessionCount;
            $player['pfr'] /= $sessionCount;
        }

        return $rankings;
    }
}
