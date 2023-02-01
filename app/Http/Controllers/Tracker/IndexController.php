<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Models\Tracker\Location;
use App\Services\Tracker\LocationService;
use App\Services\Tracker\SessionService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(LocationService $locationService, SessionService $sessionService)
    {
        $locations = $locationService->getLocations();

        return view('tracker.index', [
            'locations' => $locations,
            'locationRankings' => $locations->mapWithKeys(static fn(Location $location): array => [
                $location->id => $locationService->getLocationRankings($location),
            ]),
            'latestSessions' => $sessionService->getLatestSessions(),
        ]);
    }
}
