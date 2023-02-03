<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected static function booted(): void
    {
        $clearCache = static function () {
            Cache::forget('announcements.latest');
        };

        static::created($clearCache);
        static::updated($clearCache);
        static::deleted($clearCache);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: function() {
                if($this->published_at === null) {
                    return 'draft';
                }

                if($this->published_at > now()) {
                    return 'pending';
                }

                return 'published';
            }
        );
    }
}
