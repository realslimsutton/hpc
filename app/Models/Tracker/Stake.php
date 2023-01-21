<?php

namespace App\Models\Tracker;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stake extends Model
{
    use HasFactory;

    protected $fillable =[
        'small_blind',
        'big_blind'
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn() => '$' . $this->small_blind . '/' . $this->big_blind
        );
    }

    public function professional_sessions(): HasMany
    {
        return $this->hasMany(ProfessionalSession::class);
    }
}
