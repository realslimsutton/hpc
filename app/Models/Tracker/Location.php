<?php

namespace App\Models\Tracker;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'featured_image_id'
    ];

    public function professional_sessions(): HasMany
    {
        return $this->hasMany(ProfessionalSession::class);
    }

    public function featured_image(): HasOne
    {
        return $this->hasOne(Media::class, 'id');
    }
}
