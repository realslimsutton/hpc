<?php

namespace App\Enums\Billing;

enum DepositStatus
{
    case Pending;
    case Completed;
    case Failed;
}
