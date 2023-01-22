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

        [$topRankings, $bottomRankings] = $this->getLocationRankings($locations);

        $latestSessions = ProfessionalSession::query()
            ->latest('date')
            ->limit(4)
            ->get()
            ->map(static fn(ProfessionalSession $session): ProfessionalSession => $session
                ->setRelation('location', $locations[$session->location_id])
            );

        return view('tracker.index', [
            'locations' => $locations,
            'topRankings' => $topRankings,
            'bottomRankings' => $bottomRankings,
            'latestSessions' => $latestSessions
        ]);
    }

    private function getLocationRankings(Collection $locations): array
    {
        $locationRankings = $this->getCumulativeTotals($locations);

        return [
            collect($locationRankings)
                ->sortBy('net_winnings')
                ->take(5),
            collect($locationRankings)
                ->sortByDesc('net_winnings')
                ->take(5)
        ];
    }

    private function getCumulativeTotals(Collection $locations): array
    {
        $totals = [];

        foreach ($locations as $location) {
            $cacheKey = 'tracker.location.' . $location->id . '.rankings';

            if (!$rankings = Cache::get($cacheKey)) {
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

        foreach ($location->professional_sessions()->lazy() as $session) {
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
