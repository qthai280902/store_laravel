<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $search = $request->query('search');
        $currentPage = (int) $request->query('page', 1);

        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $query = Post::where('is_published', true);

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Hero Spotlight hiển thị ở trang 1 khi xem tất cả bài viết (không có tìm kiếm/danh mục cụ thể)
        $featuredPost = null;
        if ($currentPage === 1 && empty($selectedCategory) && empty($search)) {
            $featuredPost = (clone $query)->latest()->first();
            if ($featuredPost) {
                // Loại trừ ID của bài viết Spotlight để tránh trùng lặp ở danh sách bên dưới
                $query->where('id', '!=', $featuredPost->id);
            }
        }

        $posts = $query->latest()->paginate(6)->withQueryString();

        return view('blog.index', compact('posts', 'categories', 'selectedCategory', 'featuredPost', 'search'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // 3 bài viết liên quan cùng chuyên mục, loại trừ bài viết hiện tại
        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $extra = Post::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->latest()
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($extra);
        }

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
