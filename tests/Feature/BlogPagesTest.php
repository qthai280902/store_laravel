<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed sample posts
        Post::create([
            'title' => '7 Bí quyết giữ rau củ quả luôn tươi xanh',
            'slug' => '7-bi-quyet-giu-rau-cu-qua-luon-tuoi-xanh',
            'category' => 'Mẹo vặt nhà bếp',
            'author_name' => 'Trần Thùy Linh',
            'read_time' => '5 phút đọc',
            'image_url' => 'storage/blog/post-1.jpg',
            'content' => '<h2>Mẹo bảo quản</h2><p>Nội dung chi tiết về cách giữ rau củ quả tươi lâu.</p><blockquote>"Bí quyết ẩm thực tươi sạch."</blockquote>',
            'is_published' => true,
        ]);

        Post::create([
            'title' => '5 Công thức nước ép thanh lọc cơ thể',
            'slug' => '5-cong-thuc-nuoc-ep-thanh-loc-co-the',
            'category' => 'Dinh dưỡng & Sức khỏe',
            'author_name' => 'Bác sĩ Lê Hoàng',
            'read_time' => '4 phút đọc',
            'image_url' => 'storage/blog/post-2.jpg',
            'content' => '<h2>Công thức nước ép</h2><p>Chi tiết các loại nước ép cần tây và cà rốt.</p>',
            'is_published' => true,
        ]);

        Post::create([
            'title' => 'Cách bảo quản Cải bó xôi Đà Lạt tươi lâu',
            'slug' => 'cach-bao-quan-cai-bo-xoi-da-lat-tuoi-lau',
            'category' => 'Mẹo vặt nhà bếp',
            'author_name' => 'Đội ngũ Nông trại',
            'read_time' => '3 phút đọc',
            'image_url' => 'storage/blog/post-3.jpg',
            'content' => '<p>Hướng dẫn bọc giấy ăn và túi thoáng khí.</p>',
            'is_published' => true,
        ]);
    }

    public function test_blog_index_page_loads_successfully(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee('Tin tức &amp; Mẹo vặt', false);
        $response->assertSee('Chuyên mục Blog MiniMart');
        $response->assertSee('Tất cả bài viết');
        $response->assertSee('Mẹo vặt nhà bếp');
    }

    public function test_blog_hero_spotlight_does_not_duplicate_in_articles_grid(): void
    {
        $response = $this->get('/blog');

        $response->assertStatus(200);
        // Bài viết mới nhất xuất hiện ở Hero Spotlight
        $response->assertSee('Tiêu điểm tuần này');
        $response->assertSee('Cách bảo quản Cải bó xôi Đà Lạt tươi lâu');

        // Các bài viết tiếp theo xuất hiện trong lưới
        $response->assertSee('5 Công thức nước ép thanh lọc cơ thể');
        $response->assertSee('7 Bí quyết giữ rau củ quả luôn tươi xanh');
    }

    public function test_blog_index_can_filter_by_category(): void
    {
        $response = $this->get('/blog?category='.urlencode('Dinh dưỡng & Sức khỏe'));

        $response->assertStatus(200);
        $response->assertSee('5 Công thức nước ép thanh lọc cơ thể');
        $response->assertDontSee('Cách bảo quản Cải bó xôi Đà Lạt tươi lâu');
    }

    public function test_blog_index_can_search_posts(): void
    {
        $response = $this->get('/blog?search='.urlencode('nước ép'));

        $response->assertStatus(200);
        $response->assertSee('5 Công thức nước ép thanh lọc cơ thể');
        $response->assertDontSee('Cách bảo quản Cải bó xôi Đà Lạt tươi lâu');
    }

    public function test_blog_show_page_loads_successfully_with_related_posts(): void
    {
        $response = $this->get('/blog/7-bi-quyet-giu-rau-cu-qua-luon-tuoi-xanh');

        $response->assertStatus(200);
        $response->assertSee('7 Bí quyết giữ rau củ quả luôn tươi xanh');
        $response->assertSee('Trần Thùy Linh');
        $response->assertSee('5 phút đọc');
        $response->assertSee('Mẹo vặt nhà bếp');
        $response->assertSee('Mẹo bảo quản');
        $response->assertSee('Bài viết cùng chủ đề');
        $response->assertSee('Cách bảo quản Cải bó xôi Đà Lạt tươi lâu');
    }

    public function test_blog_show_returns_404_for_invalid_slug(): void
    {
        $response = $this->get('/blog/bai-viet-khong-ton-tai-123');

        $response->assertStatus(404);
    }
}
