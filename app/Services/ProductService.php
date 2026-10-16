<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * Retrieve a paginated list of products based on filters and sorting.
     */
    public function getProducts(array $filters = [], string $sortBy = 'created_at', string $sortDir = 'desc', int $perPage = 20): LengthAwarePaginator
    {
        $query = Product::with(['category', 'variants'])->where('is_active', true);

        // 1. Category filter (by ID or Slug)
        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        } elseif (! empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // 2. Search keyword
        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('sku', 'like', '%'.$search.'%')
                    ->orWhere('brand', 'like', '%'.$search.'%')
                    ->orWhere('origin', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        // 3. Tiêu chuẩn chất lượng (standard: all, vietgap, organic, ocop, imported)
        if (! empty($filters['standard']) && $filters['standard'] !== 'all') {
            $standard = $filters['standard'];
            if ($standard === 'vietgap') {
                $query->where(function ($q) {
                    $q->where('origin', 'like', '%VietGAP%')
                        ->orWhere('origin', 'like', '%GlobalGAP%')
                        ->orWhere('description', 'like', '%VietGAP%')
                        ->orWhere('description', 'like', '%GlobalGAP%')
                        ->orWhere('origin', 'like', '%Đà Lạt%')
                        ->orWhere('origin', 'like', '%Bến Tre%');
                });
            } elseif ($standard === 'organic') {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%organic%')
                        ->orWhere('name', 'like', '%hữu cơ%')
                        ->orWhere('description', 'like', '%organic%')
                        ->orWhere('description', 'like', '%hữu cơ%')
                        ->orWhere('brand', 'like', '%organic%')
                        ->orWhere('origin', 'like', '%organic%');
                });
            } elseif ($standard === 'ocop') {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%OCOP%')
                        ->orWhere('description', 'like', '%OCOP%')
                        ->orWhere('description', 'like', '%đặc sản%')
                        ->orWhere('origin', 'like', '%Phú Quốc%')
                        ->orWhere('origin', 'like', '%Bến Tre%')
                        ->orWhere('origin', 'like', '%Cà Mau%')
                        ->orWhere('origin', 'like', '%Sóc Trăng%')
                        ->orWhere('brand', 'like', '%Khải Hoàn%')
                        ->orWhere('brand', 'like', '%Ông Cua%');
                });
            } elseif ($standard === 'imported') {
                $query->where(function ($q) {
                    $q->where('origin', 'like', '%Úc%')
                        ->orWhere('origin', 'like', '%New Zealand%')
                        ->orWhere('origin', 'like', '%Mỹ%')
                        ->orWhere('origin', 'like', '%Na Uy%')
                        ->orWhere('origin', 'like', '%Hàn Quốc%')
                        ->orWhere('origin', 'like', '%Nhật%')
                        ->orWhere('origin', 'like', '%Nhập khẩu%');
                });
            }
        }

        // 4. Đặc tính & Tiện lợi (freshness_type: all, fresh, rtc, dry)
        if (! empty($filters['freshness_type']) && $filters['freshness_type'] !== 'all') {
            $freshness = $filters['freshness_type'];
            if ($freshness === 'fresh') {
                $query->where(function ($q) {
                    $q->where('sku', 'like', 'MM-VEG-%')
                        ->orWhere('sku', 'like', 'MM-FRU-%')
                        ->orWhere('sku', 'like', 'MM-MEA-%')
                        ->orWhere('sku', 'like', 'MM-SEA-%')
                        ->orWhereHas('category', function ($cq) {
                            $cq->whereIn('slug', [
                                'rau-cu-huu-co-da-lat',
                                'trai-cay-dac-san-nhap-khau',
                                'thit-sach-trung-tuoi',
                                'thuy-hai-san-tuoi-song',
                            ]);
                        });
                });
            } elseif ($freshness === 'rtc') {
                $query->where(function ($q) {
                    $q->where('sku', 'like', 'MM-RTC-%')
                        ->orWhereHas('category', function ($cq) {
                            $cq->where('slug', 'mon-so-che-san-ready-to-cook');
                        });
                });
            } elseif ($freshness === 'dry') {
                $query->where(function ($q) {
                    $q->where('sku', 'like', 'MM-CER-%')
                        ->orWhere('sku', 'like', 'MM-SPC-%')
                        ->orWhereHas('category', function ($cq) {
                            $cq->whereIn('slug', [
                                'gao-ngu-coc-luong-thuc-sach',
                                'gia-vi-truyen-thong-tu-nhien',
                            ]);
                        });
                });
            }
        }

        // 5. Tùy chọn nhanh: on_sale, in_stock
        if (! empty($filters['on_sale'])) {
            $query->whereNotNull('original_price')
                ->whereColumn('original_price', '>', 'base_price');
        }

        if (! empty($filters['in_stock'])) {
            $query->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhereHas('variants', function ($vq) {
                        $vq->where('stock_quantity', '>', 0);
                    });
            });
        }

        // Sorting
        if ($sortBy === 'price_asc') {
            $query->orderBy('base_price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('base_price', 'desc');
        } elseif ($sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy($sortBy, $sortDir)->orderBy('id', 'desc');
        }

        return $query->paginate($perPage);
    }

    /**
     * Retrieve a product's details by its slug.
     */
    public function getProductDetails(string $slug): ?Product
    {
        return Product::with(['category', 'variants' => function ($query) {
            $query->where('is_active', true);
        }, 'reviews.user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    /**
     * Retrieve a category by its slug with its active products.
     */
    public function getCategoryWithProducts(string $slug, array $filters = [], string $sortBy = 'created_at', string $sortDir = 'desc', int $perPage = 20): array
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $filters['category_id'] = $category->id;
        $products = $this->getProducts($filters, $sortBy, $sortDir, $perPage);

        return [
            'category' => $category,
            'products' => $products,
        ];
    }
}
