# UI Update Walkthrough (v4_p2 Liquid Glass)

## Nguồn giao diện (Source of UI)
- Thư mục: `scratch/ui_kit/stitch_minimart_liquid_glass_v4_p2/`
- Các file HTML đã tham khảo:
  - `homepage_minimart_updated/code.html`
  - `organic_gala_apples_minimart_updated/code.html`
  - `stitch_minimart_liquid_glass_v4_p1/fresh_produce_minimart/code.html`

## Các file đã cập nhật trong dự án (Blade Views & CSS)

### 1. `resources/css/app.css`
- Đã trích xuất toàn bộ config JSON từ script `tailwind-config` trong HTML file và chuyển đổi thành định dạng `@theme {}` cho Tailwind v4.
- Sao chép toàn bộ class CSS tùy chỉnh như `.ambient-bg`, `.orb`, `.glass-tier-*`, `.hide-scrollbar` vào `app.css`.

### 2. `resources/views/components/layouts/app.blade.php`
- Cập nhật `<nav>` (TopNavBar) để khớp với giao diện kính (glassmorphism) có border.
- Thêm các hiệu ứng `.ambient-bg` với các `.orb`.
- Giữ nguyên toàn bộ logic `@auth`, đăng nhập/đăng xuất, tìm kiếm, giỏ hàng.
- Cập nhật lại Footer.

### 3. `resources/views/components/product-card.blade.php`
- Bê nguyên markup HTML của thẻ sản phẩm từ bộ UI v4_p2.
- Áp dụng các biến `$product->name`, `$product->image_url`, `$product->base_price`, v.v. vào đúng vị trí.
- Giữ nguyên form `POST` thêm vào giỏ hàng (`cart.add`).

### 4. `resources/views/home.blade.php`
- Cấu trúc lại Grid system và bọc các sản phẩm (của danh mục mới nhất) vào Grid.
- Thêm Hero section và Category Tiles.
- Gắn biến `$categories`, `$icons`, vòng lặp `@foreach($latestProducts as $product)` vào cấu trúc.

### 5. `resources/views/products/index.blade.php`
- Thay thế hoàn toàn giao diện danh sách sản phẩm bằng layout có Sidebar bên trái và Grid 9 cột bên phải.
- Xử lý lại phân trang và layout "Không có sản phẩm".

### 6. `resources/views/products/show.blade.php`
- Cập nhật trang chi tiết sản phẩm chuẩn HTML của "organic_gala_apples_minimart_updated".
- Xử lý logic chọn Biến thể (Variants), cập nhật form số lượng (`quantity`) với `<input type="radio">` style đẹp mắt, giữ chức năng submit form `cart.add`.
- Xử lý logic hiển thị thông báo `session('success')` nếu thêm thành công.

## Lệnh đã chạy
- `npm run build`: Để biên dịch CSS Tailwind v4 mới (file build khoảng 93kB).
- `vendor/bin/pint --format agent`: Định dạng lại file code cho chuẩn conventions.
