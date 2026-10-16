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

    /**
     * Get accurate storage condition and shelf life specifications.
     */
    public function getStorageSpecsAttribute(): array
    {
        $catSlug = $this->category?->slug ?? '';
        $sku = $this->sku ?? '';

        // Món sơ chế sẵn (Ready-to-cook)
        if ($catSlug === 'mon-so-che-san-ready-to-cook' || str_starts_with($sku, 'MM-RTC-')) {
            return [
                'storage' => 'Ngăn mát tủ lạnh (2°C – 5°C)',
                'temp' => 'Ngăn mát 2°C – 5°C',
                'shelf_life' => '24 – 48 giờ',
                'instructions' => 'Giữ kín trong khay seal nguyên vẹn, để ngăn mát chuyên dụng và dùng ngay sau khi mở seal.',
                'warning' => 'Chế biến chín kỹ trước khi ăn, không tái cấp đông sau khi đã rã đông hoặc mở bao bì.',
                'certification' => 'Chuẩn Sơ Chế An Toàn HACCP / VietGAP',
            ];
        }

        // Rau củ & Trái cây tươi
        if ($this->product_tier === self::TIER_FRESH_PRODUCE) {
            return [
                'storage' => 'Ngăn mát tủ lạnh (4°C – 8°C)',
                'temp' => 'Ngăn mát 4°C – 8°C',
                'shelf_life' => '3 – 5 ngày',
                'instructions' => 'Bọc giấy thấm ẩm hoặc bảo quản trong hộp kín có lỗ thông khí trong ngăn rau củ.',
                'warning' => 'Không rửa nước trước khi cất tủ lạnh để tránh đọng ẩm gây thối hỏng.',
                'certification' => 'Đạt chuẩn VietGAP / GlobalGAP',
            ];
        }

        // Thịt sạch & Thủy hải sản
        if ($this->product_tier === self::TIER_MEAT_SEAFOOD) {
            return [
                'storage' => 'Ngăn mát (0°C – 4°C) hoặc Ngăn đông (-18°C)',
                'temp' => 'Ngăn đông ≤ -18°C hoặc mát 0°C – 4°C',
                'shelf_life' => 'Dùng trong 1 – 2 ngày (mát) hoặc 1 tháng (đông)',
                'instructions' => 'Đựng trong hộp kín hoặc túi hút chân không, bảo quản riêng biệt ngăn thịt cá tươi sống.',
                'warning' => 'Sau khi rã đông nên chế biến hết trong ngày, không cấp đông lại.',
                'certification' => 'Kiểm dịch Thú y & Cấp đông sâu',
            ];
        }

        // Gạo, Ngũ cốc & Gia vị khô
        return [
            'storage' => 'Nơi khô ráo, thoáng mát, tránh nắng trực tiếp',
            'temp' => 'Nhiệt độ phòng (20°C – 28°C)',
            'shelf_life' => '6 – 12 tháng kể từ NSX',
            'instructions' => 'Đậy kín nắp chai lọ hoặc buộc kín miệng túi sau khi mở nắp, tránh ẩm mốc và côn trùng.',
            'warning' => 'Để nơi thoáng khí, tránh ánh nắng mặt trời chiếu trực tiếp.',
            'certification' => 'Chuẩn An Toàn Vệ Sinh Thực Phẩm & OCOP',
        ];
    }

    /**
     * Get nutritional profile and allergen advice per 100g.
     */
    public function getNutritionDataAttribute(): array
    {
        $name = mb_strtolower($this->name, 'UTF-8');
        $tier = $this->product_tier;

        if (str_contains($name, 'bò') || str_contains($name, 'thịt')) {
            return [
                'calories' => '245 kcal',
                'protein' => '26.2 g',
                'fat' => '15.4 g',
                'carbs' => '0 g',
                'fiber' => '0 g',
                'minerals' => 'Sắt hữu cơ, Kẽm, Vitamin B12',
                'benefits' => 'Bổ sung hàm lượng sắt hữu cơ dồi dào, hỗ trợ tái tạo hồng cầu và phát triển cơ bắp săn chắc.',
                'allergens' => 'Không gây dị ứng thông thường. Phù hợp chế độ Eat Clean và Gym.',
                'allergen_warning' => 'Không gây dị ứng thông thường. Phù hợp chế độ Eat Clean và Gym.',
            ];
        }

        if (str_contains($name, 'tôm') || str_contains($name, 'cá') || str_contains($name, 'hải sản')) {
            return [
                'calories' => '115 kcal',
                'protein' => '23.8 g',
                'fat' => '1.8 g',
                'carbs' => '0.2 g',
                'fiber' => '0 g',
                'minerals' => 'Canxi tự nhiên, Omega-3, Phốt pho',
                'benefits' => 'Nguồn axit béo Omega-3 tự nhiên tốt cho tim mạch, cùng canxi hữu cơ tăng cường xương khớp.',
                'allergens' => 'Có chứa thành phần giáp xác / thủy sản. Người có tiền sử dị ứng hải sản nên lưu ý.',
                'allergen_warning' => 'Có chứa thành phần giáp xác / thủy sản. Người có tiền sử dị ứng hải sản nên lưu ý.',
            ];
        }

        if (str_contains($name, 'trứng')) {
            return [
                'calories' => '143 kcal',
                'protein' => '13.0 g',
                'fat' => '9.5 g',
                'carbs' => '0.7 g',
                'fiber' => '0 g',
                'minerals' => 'Choline, Vitamin A, Vitamin D',
                'benefits' => 'Dồi dào choline và axit amin thiết yếu giúp nuôi dưỡng tế bào não và tăng cường thị lực.',
                'allergens' => 'Chứa protein từ trứng gia cầm tự nhiên.',
                'allergen_warning' => 'Chứa protein từ trứng gia cầm.',
            ];
        }

        if (str_contains($name, 'gạo') || str_contains($name, 'yến mạch') || str_contains($name, 'đậu')) {
            return [
                'calories' => '352 kcal',
                'protein' => '8.5 g',
                'fat' => '1.2 g',
                'carbs' => '76.8 g',
                'fiber' => '3.5 g',
                'minerals' => 'Vitamin B1, Magie, Kali tự nhiên',
                'benefits' => 'Cung cấp năng lượng tinh sạch kéo dài, giàu chất xơ hòa tan hỗ trợ tiêu hóa êm ái.',
                'allergens' => 'Thuần thực vật lành tính. Không chứa gluten gây hại.',
                'allergen_warning' => 'Thuần thực vật lành tính. Không chứa gluten gây hại.',
            ];
        }

        if ($tier === self::TIER_FRESH_PRODUCE) {
            return [
                'calories' => '38 kcal',
                'protein' => '1.8 g',
                'fat' => '0.3 g',
                'carbs' => '7.4 g',
                'fiber' => '2.8 g',
                'minerals' => 'Vitamin C, Vitamin A, Axit Folic',
                'benefits' => 'Hàm lượng chất chống oxy hóa và vitamin C dồi dào, giúp thanh lọc cơ thể và sáng khỏe làn da.',
                'allergens' => 'Thuần chay 100% tự nhiên. An toàn tuyệt đối cho người mẫn cảm.',
                'allergen_warning' => 'Thuần chay 100% tự nhiên. An toàn tuyệt đối cho người mẫn cảm.',
            ];
        }

        return [
            'calories' => '180 kcal',
            'protein' => '16.5 g',
            'fat' => '8.2 g',
            'carbs' => '6.4 g',
            'fiber' => '1.5 g',
            'minerals' => 'Khoáng vi lượng và dưỡng chất thiết yếu',
            'benefits' => 'Cân bằng vi chất dinh dưỡng cho bữa cơm gia đình tươi ngon tròn vị.',
            'allergens' => 'Vui lòng kiểm tra kỹ nhãn gia vị ướp sẵn đi kèm.',
            'allergen_warning' => 'Vui lòng kiểm tra kỹ nhãn gia vị ướp sẵn đi kèm.',
        ];
    }

    /**
     * Get traceability metadata (Batch, Farm, Inspection, QR).
     */
    public function getTraceabilityDataAttribute(): array
    {
        $idPart = str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
        $batchId = 'MM-LOT-202610-'.$idPart;
        $farm = $this->origin ?: 'Hợp tác xã Nông nghiệp Công nghệ cao';
        $cert = $this->storage_specs['certification'] ?? 'VietGAP / GlobalGAP';
        $harvest = 'Thu hoạch & Đóng gói trong 12 - 24 giờ';
        $inspector = 'Viện Kiểm Nghiệm Nông Lâm Thủy Sản & Chi Cục ATTP';
        $qr = "https://trace.minimart.local/verify?sku={$this->sku}&lot={$batchId}";

        return [
            'batch_id' => $batchId,
            'farm' => $farm,
            'farm_origin' => $farm,
            'cert' => $cert,
            'cert_label' => $cert,
            'harvest_date' => $harvest,
            'harvest_time' => $harvest,
            'inspector' => $inspector,
            'qr_code_payload' => $qr,
        ];
    }

    /**
     * Get 3-step usage and preparation guide.
     */
    public function getUsageGuideAttribute(): array
    {
        $catSlug = $this->category?->slug ?? '';
        $sku = $this->sku ?? '';

        if ($catSlug === 'mon-so-che-san-ready-to-cook' || str_starts_with($sku, 'MM-RTC-')) {
            $steps = [
                ['title' => 'Mở khay & Khởi động', 'desc' => 'Lấy các túi nguyên liệu ra khỏi khay mát 10 phút trước khi nấu để các thớ thịt đạt nhiệt độ phòng.'],
                ['title' => 'Chế biến hỏa tốc', 'desc' => 'Đảo nhanh trên lửa lớn (với món xào/lúc lắc) hoặc cho gói nước dùng và nguyên liệu vào đun sôi 8 - 10 phút (với món lẩu/canh).'],
                ['title' => 'Thưởng thức trọn vị', 'desc' => 'Dùng ngay khi còn nóng hổi cùng cơm trắng hoặc bún tươi để cảm nhận vị ngọt đậm đà nguyên bản.'],
            ];

            return [
                'steps' => $steps,
                'step_1' => $steps[0],
                'step_2' => $steps[1],
                'step_3' => $steps[2],
                'prep_time' => '15 - 20 phút',
                'difficulty' => 'Rất dễ',
                'serving' => '2 - 3 người',
            ];
        }

        if ($this->product_tier === self::TIER_MEAT_SEAFOOD) {
            $steps = [
                ['title' => 'Sơ chế & Thấm khô', 'desc' => 'Dùng khăn giấy chuyên dụng thấm nhẹ bề mặt thịt/hải sản, không rửa ngâm nước lâu để giữ nguyên thớ ngọt.'],
                ['title' => 'Nêm nếm tinh tế', 'desc' => 'Ướp nhẹ với một chút muối khoáng, tiêu chín Phú Quốc hoặc dầu ô liu 5 - 10 phút trước khi nấu.'],
                ['title' => 'Gia nhiệt chuẩn độ', 'desc' => 'Áp chảo lửa lớn hoặc hấp cách thủy vừa chín tới để giữ nước thịt mọng mềm, ngọt đậm đà.'],
            ];

            return [
                'steps' => $steps,
                'step_1' => $steps[0],
                'step_2' => $steps[1],
                'step_3' => $steps[2],
                'prep_time' => '20 - 30 phút',
                'difficulty' => 'Trung bình',
                'serving' => '3 - 4 người',
            ];
        }

        if ($this->product_tier === self::TIER_FRESH_PRODUCE) {
            $steps = [
                ['title' => 'Rửa sạch dưới vòi nước', 'desc' => 'Xả nhẹ nhàng dưới vòi nước chảy hoặc ngâm nước muối loãng 3 - 5 phút để bảo toàn lớp phấn tự nhiên.'],
                ['title' => 'Cắt gọt / Chuẩn bị', 'desc' => 'Cắt tỉa phần cuống hoặc thái lát vừa ăn ngay trước khi sử dụng để tránh oxy hóa mất vitamin.'],
                ['title' => 'Thưởng thức tươi giòn', 'desc' => 'Dùng trực tiếp, trộn salad sốt mè rang hoặc xào nhanh lửa to để giữ trọn độ giòn mọng.'],
            ];

            return [
                'steps' => $steps,
                'step_1' => $steps[0],
                'step_2' => $steps[1],
                'step_3' => $steps[2],
                'prep_time' => '5 - 10 phút',
                'difficulty' => 'Rất dễ',
                'serving' => 'Cả gia đình',
            ];
        }

        $steps = [
            ['title' => 'Đong đếm chuẩn tỷ lệ', 'desc' => 'Dùng muỗng hoặc cốc đong theo định lượng khuyến nghị để món ăn đạt hương vị thơm ngon nhất.'],
            ['title' => 'Nấu chín / Pha chế', 'desc' => 'Gia nhiệt hoặc hòa quyện cùng các nguyên liệu tươi sống khác theo công thức món ăn gia đình.'],
            ['title' => 'Bảo quản sau khi mở', 'desc' => 'Đậy kín nắp chai hoặc gài kín miệng túi zip sau mỗi lần dùng, để nơi khô ráo thoáng mát.'],
        ];

        return [
            'steps' => $steps,
            'step_1' => $steps[0],
            'step_2' => $steps[1],
            'step_3' => $steps[2],
            'prep_time' => '10 - 15 phút',
            'difficulty' => 'Dễ',
            'serving' => 'Khẩu phần tùy chọn',
        ];
    }

    /**
     * Get 2 complementary products to form a smart grocery combo.
     */
    public function getFrequentlyBoughtProductsAttribute()
    {
        return self::with('variants')
            ->where('is_active', true)
            ->where('id', '!=', $this->id)
            ->where('category_id', '!=', $this->category_id)
            ->inRandomOrder(crc32($this->sku ?: (string) $this->id)) // deterministic per product
            ->take(2)
            ->get();
    }

    /**
     * Get a punchy short description (2-3 sentences max).
     */
    public function getShortDescriptionAttribute(): string
    {
        $brandText = $this->brand ? " từ thương hiệu {$this->brand}" : '';
        $originText = $this->origin ? " (xuất xứ {$this->origin})" : '';

        return "{$this->name}{$brandText}{$originText}, tuyển chọn loại 1 tươi mới mỗi ngày. Đạt chứng chỉ kiểm nghiệm an toàn sinh học, mang lại hương vị tươi ngon trọn vẹn cho bữa cơm gia đình.";
    }

    /**
     * Deep narrative storytelling and 3-No commitments.
     */
    public function getStoryAttribute(): array
    {
        $title = "Câu chuyện Nông sản & Hành trình từ Nông trại đến Bàn ăn: {$this->name}";
        $lead = "Từng sản phẩm {$this->name} được MiniMart thu hoạch trực tiếp tại những vùng nông nghiệp trọng điểm đạt chuẩn thổ nhưỡng tốt nhất.";
        $narrative = 'Chúng tôi áp dụng quy trình kiểm soát chuỗi lạnh khép kín (Cold Chain Logistics) ngay từ khâu sơ chế tại nông trường cho đến tận quầy kệ siêu thị, đảm bảo nguyên vẹn độ tươi mới, màu sắc và hàm lượng vitamin quý giá.';
        $commitments = [
            '100% tự nhiên, tuyệt đối không dùng chất bảo quản hóa học hay hóa chất giữ tươi tổng hợp.',
            'Kiểm nghiệm dư lượng thuốc BVTV đạt chuẩn VietGAP / GlobalGAP trước mỗi đợt xuất kho.',
            'Vận chuyển chuyên dụng bằng thùng giữ nhiệt, giữ độ mát lạnh nguyên bản đến tận tay bạn.',
        ];

        return [
            'title' => $title,
            'headline' => $title,
            'lead' => $lead,
            'narrative' => $narrative,
            'paragraphs' => [$narrative],
            'commitments' => $commitments,
        ];
    }
}
