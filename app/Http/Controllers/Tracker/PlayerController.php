<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Services\Tracker\PlayerService;
use App\Services\Tracker\SessionService;

class PlayerController extends Controller
{
    public function __invoke(PlayerService $playerService, SessionService $sessionService, $id)
    {
        $player = $playerService->findOrFail($id);

        return view('tracker.player', [
            'player' => $player,
            'facts' => $playerService->getFacts($player),
            'breakdownByLocation' => $sessionService->getBreakdownByLocation($player->sessions),
            'historicalChart' => $sessionService->getHistoricalChart($player->sessions),
        ]);
    }
}
