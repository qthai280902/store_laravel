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
     * Product Tiers for Organic / Clean Groceries.
     */
    public const TIER_FRESH_PRODUCE = 'tier_fresh_produce';

    public const TIER_MEAT_SEAFOOD = 'tier_meat_seafood';

    public const TIER_PACKAGED_GOODS = 'tier_packaged_goods';

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

    /**
     * Determine product tier based on category.
     */
    public function getProductTierAttribute(): string
    {
        $slug = $this->category?->slug ?? '';
        $name = mb_strtolower($this->category?->name ?? '', 'UTF-8');

        if (
            in_array($slug, ['rau-cu-huu-co-da-lat', 'trai-cay-dac-san-nhap-khau', 'rau-cu', 'trai-cay', 'rau-cu-huu-co', 'trai-cay-nhap-khau'], true)
            || str_contains($name, 'rau') || str_contains($name, 'củ') || str_contains($name, 'trái cây') || str_contains($name, 'hoa quả')
        ) {
            return self::TIER_FRESH_PRODUCE;
        }

        if (
            in_array($slug, ['thit-sach-trung-tuoi', 'thuy-hai-san-tuoi-song', 'thit-ca', 'hai-san', 'thuc-pham-tuoi-song'], true)
            || str_contains($name, 'thịt') || str_contains($name, 'hải sản') || str_contains($name, 'cá') || str_contains($name, 'tôm') || str_contains($name, 'trứng')
        ) {
            return self::TIER_MEAT_SEAFOOD;
        }

        return self::TIER_PACKAGED_GOODS;
    }

    /**
     * Mapping of compact 5-angle labels tailored to fit thumbnail badges.
     */
    public static function angleLabelsByTier(): array
    {
        return [
            self::TIER_FRESH_PRODUCE => [
                0 => 'Chính diện',
                1 => 'Nguồn gốc',
                2 => 'Đóng gói',
                3 => 'Cận cảnh',
                4 => 'Thưởng thức',
            ],
            self::TIER_MEAT_SEAFOOD => [
                0 => 'Đóng khay',
                1 => 'Kiểm dịch',
                2 => 'Góc cắt 45°',
                3 => 'Thớ thịt tươi',
                4 => 'Món ngon',
            ],
            self::TIER_PACKAGED_GOODS => [
                0 => 'Bao bì',
                1 => 'Dinh dưỡng',
                2 => 'Góc nghiêng',
                3 => 'Chất lượng hạt',
                4 => 'Bữa ăn',
            ],
        ];
    }

    /**
     * Helper for Admin forms to retrieve angle labels when selecting a category.
     */
    public static function getAngleLabelsForCategory(?Category $category): array
    {
        if (! $category) {
            return self::angleLabelsByTier()[self::TIER_PACKAGED_GOODS];
        }

        $dummy = new self;
        $dummy->setRelation('category', $category);

        return self::angleLabelsByTier()[$dummy->product_tier];
    }

    /**
     * Get dynamic 5-angle labels for the product.
     */
    public function getAngleLabelsAttribute(): array
    {
        $tiers = self::angleLabelsByTier();

        return $tiers[$this->product_tier] ?? $tiers[self::TIER_PACKAGED_GOODS];
    }
}
