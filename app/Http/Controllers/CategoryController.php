<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function show(string $slug, Request $request)
    {
        $filters = $request->only(['search']);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');

        $data = $this->productService->getCategoryWithProducts($slug, $filters, $sortBy, $sortDir);

        return view('categories.show', [
            'category' => $data['category'],
            'products' => $data['products'],
        ]);
    }
}
