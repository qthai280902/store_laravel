<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::latest()->take(10)->get();
        $featuredProducts = Product::where('is_featured', true)->inRandomOrder()->take(10)->get();
        if ($featuredProducts->count() < 5) {
            $featuredProducts = Product::inRandomOrder()->take(10)->get();
        }
        $flashSales = Product::inRandomOrder()->take(10)->get();
        
        $categories = Category::all();
        $latestPosts = Post::where('is_published', true)->latest()->take(3)->get();

        return view('home', compact('newProducts', 'featuredProducts', 'flashSales', 'categories', 'latestPosts'));
    }
}
