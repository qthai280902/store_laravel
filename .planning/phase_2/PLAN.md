# Phase 2: Tích hợp NativePHP và Tối ưu UI Mobile

## Mục tiêu
- Cài đặt NativePHP (`nativephp/laravel`) trực tiếp vào dự án.
- Thiết lập chuẩn UI "Organic Minimalist" cho ứng dụng Mobile qua CSS Variables và CSS Grid.
- Tái sử dụng toàn bộ Domain Services và Controller đã xây dựng ở Phase 1.

## Các thiết lập UI (resources/css/app.css)
- Màu sắc: `--color-primary` (`#0d631b`), `--color-secondary` (`#994700`), `--color-surface-container` (`#ebefe5`).
- Đổ bóng: `--shadow-resting` (`0px 4px 12px rgba(0,0,0,0.05)`), `--shadow-hover` (`0px 8px 24px rgba(0,0,0,0.1)`).
- Typography: h1 = 32px (mobile) / 40px (desktop).
- Container layout: Grid 4 columns, 16px gap, 16px padding.

## Các task triển khai
1. Cập nhật `resources/css/app.css`.
2. Cài đặt `nativephp/laravel`.
3. Chạy `php artisan native:install`.
4. Viết báo cáo.
