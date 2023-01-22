<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\ProfessionalPlayer;
use Squire\Models\Country;

class PlayerController extends Controller
{
    public function show(ProfessionalPlayer $player)
    {
        $player->load([
            'professional_sessions' => function ($query) {
                $query->orderBy('date');
            },
            'professional_sessions.stake'
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

        return view('tracker.player', [
            'player' => $player,
            'country' => $country,
            'totalWinnings' => $totalWinnings,
            'sessionsPlayed' => $sessionsPlayed,
            'hoursPlayed' => $hoursPlayed,
            'mostPlayedStake' => $mostPlayedStake,
            'firstSession' => $firstSession,
            'chartData' => $chartData
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
        $data = [];

        foreach ($player->professional_sessions as $session) {
            $date = $session->date->format('Y-m-d');

            if (!isset($data[$date])) {
                $data[$date] = 0;
            }

            $data[$date] += $session->pivot->net_winnings;
        }

        return collect($data)
            ->map(static fn($value, $key): array => [
                'x' => $key,
                'y' => $value
            ])
            ->values()
            ->all();
    }
}
