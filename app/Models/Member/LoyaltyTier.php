<?php

namespace App\Models\Member;

use App\Models\User;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LoyaltyTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lp_requirement',
        'featured_image_id',
    ];

    protected $casts = [
        'lp_requirement' => 'integer',
    ];

    public function featured_image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'featured_image_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
