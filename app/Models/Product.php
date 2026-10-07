<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'image_url',
        'images',
        'brand',
        'origin',
        'unit',
        'weight',
        'original_price',
        'base_price',
        'stock',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'base_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'stock' => 'integer',
        'images' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get discount percentage if original price is higher than base price.
     */
    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->original_price && $this->original_price > $this->base_price) {
            return (int) round((($this->original_price - $this->base_price) / $this->original_price) * 100);
        }

        return null;
    }

    /**
     * Get primary image URL, handling local storage paths with asset().
     */
    public function getImageUrlAttribute(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return asset($value);
    }

    /**
     * Get list of gallery images, ensuring at least one image is returned.
     */
    public function getGalleryImagesAttribute(): array
    {
        $list = (is_array($this->images) && count($this->images) > 0)
            ? $this->images
            : ($this->attributes['image_url'] ?? null ? [$this->attributes['image_url']] : []);

        if (empty($list)) {
            return ['https://picsum.photos/seed/'.$this->slug.'/800/800'];
        }

        return array_map(function ($img) {
            return (str_starts_with($img, 'http://') || str_starts_with($img, 'https://'))
                ? $img
                : asset($img);
        }, $list);
    }

    /**
     * Get average rating score.
     */
    public function getAverageRatingAttribute(): float
    {
        return round((float) ($this->reviews()->avg('rating') ?? 5.0), 1);
    }

    /**
     * Get total reviews count.
     */
    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }
}
