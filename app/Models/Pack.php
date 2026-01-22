<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pack extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'service_id',
        'name',
        'slug',
        'description',
        'long_description',
        'base_price',
        'is_featured',
        'is_active',
        'sort_order',
        'included_features',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'included_features' => 'array',
    ];

    // Relationships
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)
            ->withPivot('is_included', 'additional_price')
            ->withTimestamps();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getTotalPriceAttribute(): float
    {
        $featuresPrice = $this->features()
            ->wherePivot('is_included', true)
            ->sum('features.price');

        return (float) $this->base_price + $featuresPrice;
    }

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useFallbackUrl('/images/placeholder-pack.png');

        $this->addMediaCollection('videos');
    }
}
