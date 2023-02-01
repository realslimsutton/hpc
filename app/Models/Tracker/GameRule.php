<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
