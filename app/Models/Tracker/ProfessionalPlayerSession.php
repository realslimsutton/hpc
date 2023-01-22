<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Cache;

class ProfessionalPlayerSession extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'professional_session_id',
        'professional_player_id',
        'net_winnings',
        'vpip',
        'pfr',
        'hours_played',
    ];

    protected $casts = [
        'hours_played' => 'float',
    ];

    protected static function booted(): void
    {
        static::updating(static function(ProfessionalPlayerSession $model): void {
            Cache::forget('tracker.location.' . $model->professional_session->location_id . '.rankings');
        });
    }

    public function professional_session(): BelongsTo
    {
        return $this->belongsTo(ProfessionalSession::class);
    }

    public function professional_player(): BelongsTo
    {
        return $this->belongsTo(ProfessionalPlayer::class);
    }

    public function netWinnings(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['net_winnings'] / 100,
            set: fn ($value) => $value * 100
        );
    }

    public function vpip(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['vpip'] * 100,
            set: fn ($value) => $value / 100
        );
    }

    public function pfr(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['pfr'] * 100,
            set: fn ($value) => $value / 100
        );
    }
}
