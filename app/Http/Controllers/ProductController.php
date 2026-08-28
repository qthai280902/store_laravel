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

        $products = $this->productService->getProducts($filters, $sortBy, $sortDir);

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
