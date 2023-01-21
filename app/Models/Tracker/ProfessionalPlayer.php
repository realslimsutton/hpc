<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProfessionalPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enabled'
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(ProfessionalSession::class, 'professional_player_sessions')
            ->using(ProfessionalPlayerSession::class)
            ->withPivot([
                'id',
                'net_winnings',
                'vpip',
                'pfr',
                'hours_played'
            ]);
    }
}
