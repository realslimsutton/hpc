<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\ProfessionalPlayer;
use App\Models\Tracker\ProfessionalSession;
use Squire\Models\Country;

class PlayerController extends Controller
{
    public function show(ProfessionalPlayer $player)
    {
        $player->load([
            'professional_sessions' => function ($query) {
                $query->orderBy('date');
            },
            'professional_sessions.stake',
            'professional_sessions.location',
            'professional_sessions.poker_game'
        ]);

        $country = null;
        if ($player->country !== null) {
            $country = Country::query()
                ->find($player->country);
        }

        $totalWinnings = $player->professional_sessions->sum('pivot.net_winnings');
        $sessionsPlayed = $player->professional_sessions->count();
        $hoursPlayed = $player->professional_sessions->sum('pivot.hours_played');
        $mostPlayedStake = $this->getMostPlayedStake($player);
        $firstSession = $player->professional_sessions->last()?->date;

        $chartData = $this->getChartData($player);

        $breakdownByLocation = $player->professional_sessions
            ->mapToGroups(fn(ProfessionalSession $session): array => [
                $session->location->name => $session
            ]);

        return view('tracker.player', [
            'player' => $player,
            'country' => $country,
            'totalWinnings' => $totalWinnings,
            'sessionsPlayed' => $sessionsPlayed,
            'hoursPlayed' => $hoursPlayed,
            'mostPlayedStake' => $mostPlayedStake,
            'firstSession' => $firstSession,
            'chartData' => $chartData,
            'breakdownByLocation' => $breakdownByLocation
        ]);
    }

    private function getMostPlayedStake(ProfessionalPlayer $player): ?string
    {
        $stakes = [];
        foreach ($player->professional_sessions as $session) {
            if (!isset($stakes[$session->stake->name])) {
                $stakes[$session->stake->name] = 0;
            }

            $stakes[$session->stake->name]++;
        }

        return collect($stakes)
            ->sort()
            ->keys()
            ->last();
    }

    private function getChartData(ProfessionalPlayer $player): array
    {
        return [
            'data' => $player->professional_sessions
                ->map(static fn(ProfessionalSession $session): array => [
                    'date' => $session->date,
                    'net_winnings' => $session->pivot->net_winnings,
                    'location' => $session->location->name,
                    'game_type' => $session->poker_game->name
                ])
                ->sortBy('date')
                ->all(),

            'locations' => $player->professional_sessions
                ->pluck('location.name')
                ->unique()
                ->sort(),

            'gameTypes' => $player->professional_sessions
                ->pluck('poker_game.name')
                ->unique()
                ->sort(),

            'minYear' => $player->professional_sessions
                ->min(static fn(ProfessionalSession $session) => $session->date->year)
        ];
    }
}
