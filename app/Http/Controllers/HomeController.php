<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->take(10)->get();
        $categories = Category::all();
        $latestPosts = Post::where('is_published', true)->latest()->take(3)->get();

        return view('home', compact('latestProducts', 'categories', 'latestPosts'));
    }
}
