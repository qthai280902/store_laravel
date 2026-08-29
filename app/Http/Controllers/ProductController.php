<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $filters = $request->only(['search']);
        
        if ($request->has('category')) {
            $category = \App\Models\Category::where('slug', $request->category)->first();
            if ($category) {
                $filters['category_id'] = $category->id;
            }
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');

        $query = \App\Models\Product::with(['category', 'variants'])->where('is_active', true);
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (isset($filters['search'])) {
            $query->where('name', 'like', '%'.$filters['search'].'%');
        }
        $query->orderBy($sortBy, $sortDir);
        $products = $query->paginate(20);

        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->get('search');
        $filters = $request->only(['search', 'category_id']);
        $products = $this->productService->getProducts($filters);

        return view('products.search', compact('products', 'keyword'));
    }

    public function show(string $slug)
    {
        $product = $this->productService->getProductDetails($slug);

        return view('products.show', compact('product'));
    }
}
