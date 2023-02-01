<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Services\Tracker\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __invoke(LocationService $locationService, $id)
    {
        $location = $locationService->findOrFail($id);

        return view('tracker.location', [
            'location' => $location
        ]);
    }
}
