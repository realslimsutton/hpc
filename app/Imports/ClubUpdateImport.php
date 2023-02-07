<?php

namespace App\Imports;

use App\Imports\ClubUpdateImport\Sheets\ClubUpdateSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClubUpdateImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Club Overview' => new ClubUpdateSheet(),
            'Ring Game Detail' => new ClubUpdateSheet(),
            'Tournament Detail' => new ClubUpdateSheet(),
            'Club Member Balance' => new ClubUpdateSheet(),
        ];
    }
}
