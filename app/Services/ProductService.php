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
    public function getProducts(array $filters = [], string $sortBy = 'created_at', string $sortDir = 'desc', int $perPage = 15): LengthAwarePaginator
    {
        $query = Product::with(['category', 'variants'])->where('is_active', true);

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['search'])) {
            $query->where('name', 'like', '%'.$filters['search'].'%');
        }

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate($perPage);
    }

    /**
     * Retrieve a product's details by its slug.
     */
    public function getProductDetails(string $slug): ?Product
    {
        return Product::with(['category', 'variants' => function ($query) {
            $query->where('is_active', true);
        }])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    /**
     * Retrieve a category by its slug with its active products.
     */
    public function getCategoryWithProducts(string $slug, array $filters = [], string $sortBy = 'created_at', string $sortDir = 'desc', int $perPage = 15)
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
