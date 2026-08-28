# Phase 9: Seeding d? li?u S?n ph?m & Blog

## 1. Tính nãng Blog/Tin t?c
- Ð? t?o migration \create_posts_table\ v?i các trý?ng: title, slug, category, content, image_url, is_published.
- Ð? t?o Model \Post\ và \PostController\.
- Ð? thêm Route \/blog\ và \/blog/{slug}\.
- Ð? xây d?ng View \posts/index.blade.php\ và \posts/show.blade.php\ chu?n Liquid Glass V4.

## 2. ProductSeeder
- C?u h?nh t?o s?n 20 s?n ph?m ða d?ng t? Rau c?, Trái cây, Týõi s?ng ð?n Khô ðóng gói.
- Giá ti?n chu?n VNÐ (25000ð - 1200000ð).
- H?nh ?nh l?y t? Unsplash siêu chân th?c.
- Ð? thêm M? cay Kimchi Hàn Qu?c cùng các tùy ch?n C?p ð? 1, 3, 7 qua \ProductVariant\.

## 3. BlogSeeder
- C?u h?nh 10 bài vi?t blog h?p d?n chia vào 3 category: M?o v?t, S?n ph?m nông s?n, S?n ph?m s?c kh?e.
- H? tr? HTML markup trong content ð? hi?n th? ð?p m?t.

## 4. B?o toàn Database
- Thay v? g?i l?nh \migrate:fresh\ gây m?t d? li?u User/Order c?, các Seeder m?i ðý?c thi?t k? an toàn và có l?nh ch?y riêng.
