<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stake extends Model
{
    use HasFactory;

    protected $fillable = [
        'small_blind',
        'big_blind',
    ];

    protected $casts = [
        'small_blind' => 'integer',
        'big_blind' => 'integer',
    ];
}
