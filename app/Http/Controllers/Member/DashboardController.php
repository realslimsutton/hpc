<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\AnnouncementService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, AnnouncementService $announcementService)
    {
        $announcements = $announcementService->latest();

        return view('member.dashboard', [
            'announcements' => $announcements,
            'user' => $request->user()
        ]);
    }
}
