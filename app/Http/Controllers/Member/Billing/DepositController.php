<?php

namespace App\Http\Controllers\Member\Billing;

use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function __invoke()
    {
        return view('member.billing.deposit');
    }
}
