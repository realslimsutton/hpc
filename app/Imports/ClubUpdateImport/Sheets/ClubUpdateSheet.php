<?php

namespace App\Imports\ClubUpdateImport\Sheets;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClubUpdateSheet implements ToCollection
{
    public function collection(Collection $collection): Collection
    {
        return $collection;
    }
}
