# Phase 10: Đại tu Navigation, Bố cục Banner Slider, 50 Sản phẩm & Thu gọn Card

## 1. Cấu trúc lại Thanh Navigation 2 Hàng (Header Upgrade)
- **app.blade.php**: Thay thế navbar cũ bằng cấu trúc `<header>` 2 hàng với thiết kế hiện đại.
- **Hàng Trên Cùng**:
  - Logo MiniMart
  - Khung tìm kiếm ở giữa (`max-w-xl`)
  - Các icon: Đơn hàng/Đăng nhập, Giỏ hàng, Menu (Hamburger icon).
- **Hàng Dưới (Sub-nav)**:
  - "Danh mục sản phẩm" (Mega menu thả xuống với 4 danh mục chính và các liên kết con khi hover).
  - Các liên kết: Blog, Giới thiệu, Hệ thống cửa hàng.
- **Off-canvas Sidebar**:
  - Tích hợp Alpine.js (`x-data="{ sidebarOpen: false }"`) để quản lý Sidebar.
  - Khi click vào icon Hamburger, Sidebar trượt ra từ bên phải hiển thị toàn bộ danh mục và các liên kết khác trên mobile/desktop.

## 2. Cụm Banner Đa Khung (Hero Section with Slider & Sub-banners)
- **home.blade.php**: Thiết kế lại khối Hero.
- **Main Slider (Banner lớn)**:
  - Chiếm không gian lớn bên trái (`lg:col-span-2`).
  - Slide tự động lặp lại mỗi 5s bằng Alpine.js (`x-data="{ slide: 1 }"`, `x-init="setInterval(...)"`).
  - Có các nút điều hướng trái/phải và dấu chấm báo vị trí dưới cùng.
- **Sub-banners (2 Banner nhỏ)**:
  - Xếp dọc bên phải slider (`lg:col-span-1`) trên giao diện desktop (`hidden lg:flex`).
  - Giới thiệu "Gạo ST25 Ông Cua" và "Combo Lẩu Nướng".

## 3. Bơm Dữ Liệu Lấp Đầy (Massive Seeding)
- **ProductSeeder**:
  - Bơm thành công 50 sản phẩm thực tế.
  - Các danh mục: Rau củ hữu cơ, Trái cây nhập khẩu, Thực phẩm tươi sống, Thực phẩm khô, Đồ uống.
  - Ảnh tự động sinh từ md5(name) thông qua picsum.photos.
- **BlogSeeder**:
  - Giới hạn lại thành 5 bài viết chất lượng.

## 4. Tinh chỉnh Thẻ Sản Phẩm (Product Card Optimization)
- **product-card.blade.php**:
  - Giảm kích thước ảnh sản phẩm bằng cách thay đổi tỷ lệ khung hình từ `aspect-[4/3]` sang `aspect-[16/9]` (rộng hơn, chiều cao thấp hơn).
  - Thêm cụm đánh giá sao (5 sao, điểm 4.8 tĩnh) và nhãn "Còn hàng".
  - Thêm nhãn giảm giá `-20%` hiển thị ngẫu nhiên (dùng `rand(0,1)`).
- **products/show.blade.php**:
  - Tối ưu chiều cao ảnh chi tiết (`max-h-[350px] object-cover` thay cho `500px`).

## Lệnh cập nhật CSDL
Bạn có thể cập nhật dữ liệu mới bằng lệnh sau:
```bash
php artisan migrate:fresh --seed
```

## Hotfix UI/UX:
- C?p nh?t n�t ��ng nh?p / ��ng k? tr�n Header.
- X�a m�u n?n t?i v� thu nh? Rating/Badge trong Product Card.
- Th�m Hero Banner cho trang Blog & Tin t?c.
