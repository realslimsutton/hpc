<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Services\Tracker\SessionService;

class SessionController extends Controller
{
    public function __invoke(SessionService $sessionService, $id)
    {
        $session = $sessionService->findOrFail($id);

        $tableData = $sessionService->getTable($session);

        return view('tracker.session', [
            'session' => $session,
            'embedUrl' => $sessionService->getEmbedUrl($session),
            'tableData' => $tableData,
        ]);
    }
}
