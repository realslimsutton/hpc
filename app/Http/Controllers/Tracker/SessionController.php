<?php

namespace App\Http\Controllers\Tracker;

use App\Http\Controllers\Controller;
use App\Services\Tracker\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __invoke(SessionService $sessionService, $id)
    {

    }
}
