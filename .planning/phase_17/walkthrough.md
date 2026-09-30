# BƯỚC ĐI (WALKTHROUGH) PHASE 17: Nâng cấp Dữ liệu Sản phẩm, Thư viện Ảnh đa góc độ & Tách Component Đánh giá

## 1. Mục tiêu
- Cập nhật schema `products` và tạo bảng `reviews`.
- Thiết lập thư viện ảnh 5 góc nhìn cho mỗi sản phẩm.
- Tách các Blade components: `x-products.gallery`, `x-products.specs`, `x-products.reviews`.
- Thể hiện các huy hiệu % giảm giá và cảnh báo tồn kho thời gian thực chuẩn Liquid Glass V4.

## 2. Công việc đã hoàn thành

### 2.1. Cập nhật Database & Models
- **Migration `products` table** (`2026_09_30_144935_add_details_to_products_table.php`):
  - Bổ sung các cột: `sku` (string, unique), `origin` (string), `weight` (string), `images` (json).
- **Migration `reviews` table** (`2026_09_30_144946_create_reviews_table.php`):
  - Tạo bảng `reviews` với `id`, `product_id`, `user_id`, `rating` (1-5), `comment`, `timestamps`, index `['product_id', 'created_at']`.
- **Eloquent Models**:
  - Model `Review`: `belongsTo(Product::class)` và `belongsTo(User::class)`.
  - Model `Product`: Thêm `hasMany(Review::class)`, cast `images` thành `array`, thêm các accessors `discount_percent`, `gallery_images`, `average_rating`, `reviews_count`.
  - Model `User`: Thêm `hasMany(Review::class)`.
  - Service `ProductService`: Eager load `reviews.user` trong `getProductDetails()`.

### 2.2. Seeders Dữ liệu Thực tế (5 ảnh/sản phẩm & Đánh giá)
- **`ProductSeeder`**:
  - Tự động sinh `sku` chuẩn e-commerce (`MM-VEG-0001`, `MM-FRU-0002`,...).
  - Bổ sung xuất xứ `origin` phong phú và quy cách `weight`.
  - Cung cấp bộ ảnh 5 góc nhìn phân theo danh mục:
    1. Bao bì / ảnh chính diện
    2. Mặt sau nhãn phụ / thông tin dinh dưỡng
    3. Góc chụp nghiêng 45°
    4. Cận cảnh kết cấu & độ tươi ngon
    5. Trải nghiệm thực tế / chế biến
- **`ReviewSeeder`**:
  - Tạo 5 tài khoản khách hàng thực tế (có avatar Unsplash).
  - Tự động sinh từ 3-7 đánh giá chân thực bằng tiếng Việt cho mỗi sản phẩm.
- **`DatabaseSeeder`**:
  - Tích hợp `ReviewSeeder::class` và bảo đảm tài khoản `thaib@example.com` có quyền `admin`.

### 2.3. Blade Components (Apple Liquid Glass V4)
- **`x-products.gallery`** (`resources/views/components/products/gallery.blade.php`):
  - Khung ảnh chính bo góc tròn `rounded-[2.5rem]`, viền phản quang Liquid Glass, hiệu ứng zoom ảnh tương tác theo con trỏ chuột (`cursor-zoom-in`).
  - Thanh thumbnail trượt ngang hiển thị nhãn góc chụp trên từng ảnh, thumbnail active có viền nổi khối `ring-2 ring-green-600 shadow-lg scale-105`.
- **`x-products.specs`** (`resources/views/components/products/specs.blade.php`):
  - Card kính mờ `bg-white/50 backdrop-blur-2xl` hiển thị dạng bảng thông số: Thương hiệu, Xuất xứ, Khối lượng, Đơn vị, Mã SKU, Trạng thái kho.
  - Tích hợp các nút điều hướng thương hiệu dạng viên thuốc kính lỏng.
- **`x-products.reviews`** (`resources/views/components/products/reviews.blade.php`):
  - Card kính lỏng độc lập hiển thị điểm đánh giá trung bình, thanh phân bổ tỉ lệ sao (1-5 sao).
  - Danh sách thẻ nhận xét khách hàng (Avatar, Tên, Badge "Đã mua hàng", Thời gian, Nội dung).
  - Form gửi đánh giá nhanh có chọn số sao tương tác qua Alpine.js, gửi dữ liệu về `ReviewController@store`.
- **Cập nhật `resources/views/products/show.blade.php`**:
  - Tích hợp % giảm giá dạng viên thuốc đỏ kính lỏng (`-X%`).
  - Cảnh báo tồn kho theo thời gian thực ("Còn hàng", "Chỉ còn X sản phẩm", "Tạm hết hàng").
  - Breadcrumb viên thuốc kính mờ lơ lửng.

### 2.4. Biên dịch & Kiểm thử
- Chạy `php artisan migrate` thành công.
- Chạy `php artisan db:seed --class=ProductSeeder` và `ReviewSeeder` thành công (300 sản phẩm & hàng ngàn lượt đánh giá thực tế).
- Chạy `npm run build` thành công trong 2.06s.
- Chạy `vendor/bin/pint --dirty --format agent` vượt qua 100%.
- Bổ sung và chạy kiểm thử Pest: **100% Passed (6/6 tests, 12 assertions)**.

---

## 3. Nhật ký Phase 17 (Debug & Refactor)

### 3.1. Vấn đề 1: Khắc phục lỗi gán sai ảnh theo ngữ cảnh & Chuẩn hóa bộ ảnh thực tế
- **Hiện trạng trước sửa:** Thư viện ảnh được gán ngẫu nhiên theo mảng tĩnh của cả danh mục lớn, dẫn đến tình trạng cá diêu hồng bị gán ảnh thịt bò nướng, nước lau kính bị gán ảnh găng tay y tế.
- **Giải pháp:** Xây dựng hàm semantic matcher `resolveImagesForProduct($name, $catName)` trong `ProductSeeder.php`. Nhận diện từ khóa tiếng Việt chính xác theo từng phân loại (Cá/fish, Bò/beef, Heo/pork, Gà/poultry, Nước lau kính/spray, Nước rửa chén, Nước giặt, Dầu gội, Kem đánh răng, Rau củ, Trái cây, Hải sản/tôm/cua/mực). Mỗi sản phẩm được cấp 5 ảnh chuẩn phân giải cao khớp tuyệt đối với tên gọi và SKU.

### 3.2. Vấn đề 2: Tái cấu trúc Layout trang Chi tiết sản phẩm (`products/show.blade.php`)
- **Hiện trạng trước sửa:** Bố cục chia cột 50/50 co cụm khiến thông số kỹ thuật và mô tả bị ép chật chội, khó đọc, xộc xệch.
- **Giải pháp:** 
  - Khối phía trên: Chia lưới tỷ lệ vàng (Gallery 45% bên trái, Thông tin mua hàng 55% bên phải) với khoảng cách thoáng đạt `gap-10 lg:gap-14`.
  - Khối Thông số kỹ thuật (`x-products.specs`): Tách thành khối độc lập toàn chiều rộng `max-w-7xl`, thiết kế bảng thông số thẻ kính Liquid Glass (`bg-white/40 backdrop-blur-3xl border border-white/80 shadow-[0_8px_32px_rgba(0,0,0,0.06)] ring-1 ring-white/50 rounded-[2.5rem] p-8 md:p-10`) với icon nhận diện và 2 nút điều hướng dạng viên thuốc kính lỏng.
  - Khối Mô tả chi tiết: Thẻ kính riêng biệt hiển thị nội dung chi tiết rõ ràng.
  - Khối Đánh giá (`x-products.reviews`): Đặt ở dưới cùng toàn chiều rộng, tạo dòng chảy trải nghiệm tự nhiên.

### 3.3. Vấn đề 3: Loại bỏ hoàn toàn hiệu ứng phóng to, biến dạng và rung lắc (Zoom/Jitter)
- **Hiện trạng trước sửa:** Gallery sử dụng cơ chế lắng nghe sự kiện `mousemove` và dịch chuyển `transform-origin` với `scale-125`, kèm `group-hover:scale-105` trên Product Card làm hình ảnh bị méo, nhảy khung và rung giật liên tục.
- **Giải pháp:**
  - Gỡ bỏ hoàn toàn `mousemove`, `zoomActive`, `zoomX/Y`, `cursor-zoom-in`, `scale-125` khỏi `resources/views/components/products/gallery.blade.php`. Khung ảnh chính giữ cố định kích thước, tĩnh, sắc nét với lớp kính phản quang tinh tế; chuyển đổi ảnh mượt mà khi nhấp vào thumbnails.
  - Loại bỏ `group-hover:scale-105` khỏi `resources/views/components/product-card.blade.php`, giữ card ổn định không bị giật bố cục khi rê chuột.

### 3.4. Vấn đề 4: Xử lý triệt để lỗi trùng lặp dữ liệu trên trang Danh mục
- **Hiện trạng trước sửa:** Xuất hiện sản phẩm lặp lại khi cuộn trang danh mục (`products/index.blade.php`).
- **Nguyên nhân & Giải pháp:**
  1. Loại bỏ vòng lặp padding gán thêm sản phẩm trùng tên `(Extra ...)` trong `ProductSeeder.php`.
  2. Bổ sung `->orderBy('id', 'desc')` làm tiebreaker trong `ProductController.php` để loại bỏ tính phi tất định khi phân trang trên các bản ghi có cùng `created_at`.
  3. Thêm cấu trúc dữ liệu `Set` (`requestedPages`) và cơ chế chống tải trùng lặp thẻ sản phẩm theo URL trong script cuộn vô tận tại `products/index.blade.php`.

### 3.5. Kết quả Xác minh
- `php artisan migrate:fresh --seed`: Thành công 100%, 200 sản phẩm đặc thù không trùng lặp, 1.023 đánh giá thực tế.
- `npm run build`: Hoàn thành trong 1.03s.
- `vendor/bin/pint --format agent`: Hoàn thành chuẩn định dạng PSR-12/Laravel Pint.
- `php artisan test --compact`: **100% Passed (6/6 tests, 12 assertions)**.

---

## 4. Nhật ký Phase 17.1: Xây dựng các trang Chính sách & Kích hoạt liên kết Footer

### 4.1. Mục tiêu hoàn thành
- Khảo sát giao diện mẫu từ `.planning/scratch/ui_kit/master_layout` và đồng bộ với hệ thống Liquid Glass V4.
- Xóa bỏ triệt để các liên kết tĩnh `href="#"` tại cột "Chính sách & Hỗ trợ" ở Footer.
- Xây dựng controller, routing và 5 view Blade hoàn chỉnh:
  1. **Chính sách đổi trả 24h** (`/chinh-sach-doi-tra` - `pages.return-policy`): Cam kết đổi trả 24h cho thực phẩm tươi sống, quy trình 3 bước siêu tốc, hình thức hoàn tiền linh hoạt (MoMo 15p, ngân hàng, voucher).
  2. **Chính sách giao hàng** (`/chinh-sach-giao-hang` - `pages.shipping-policy`): Giao hỏa tốc 2 giờ, tiêu chuẩn trong ngày, giao hẹn giờ, bảng cước phí minh bạch (FreeShip từ 300k), tiêu chuẩn bảo quản lạnh Cold Chain và quyền đồng kiểm.
  3. **Chính sách bảo mật** (`/chinh-sach-bao-mat` - `pages.privacy-policy`): Mục đích và phạm vi thu thập dữ liệu, cam kết không thương mại hóa thông tin, mã hóa SSL 256-bit / Bcrypt, quyền quản trị dữ liệu của khách hàng.
  4. **Điều khoản sử dụng** (`/dieu-khoan-su-dung` - `pages.terms`): Quy định chung, tài khoản và mật khẩu, chính sách giá đã gồm VAT, quyền sở hữu trí tuệ bộ UI Liquid Glass.
  5. **Câu hỏi thường gặp** (`/cau-hoi-thuong-gap` - `pages.faq`): Tích hợp tìm kiếm từ khóa trực tiếp, bộ lọc 4 danh mục (Đơn hàng, Thanh toán, Vận chuyển, Tài khoản) và Accordion đóng mở êm ái bằng Alpine.js (`x-collapse`).

### 4.2. Các tệp đã khởi tạo & chỉnh sửa
- `app/Http/Controllers/PageController.php`: Quản lý 5 action trả về view.
- `routes/web.php`: Khởi tạo route group `Route::controller(PageController::class)`.
- `resources/views/pages/return-policy.blade.php`: Giao diện chính sách đổi trả 24h.
- `resources/views/pages/shipping-policy.blade.php`: Giao diện chính sách giao hàng.
- `resources/views/pages/privacy-policy.blade.php`: Giao diện chính sách bảo mật.
- `resources/views/pages/terms.blade.php`: Giao diện điều khoản sử dụng.
- `resources/views/pages/faq.blade.php`: Giao diện FAQ tương tác Accordion.
- `resources/views/components/layouts/app.blade.php`: Gắn 5 route helper vào Footer.
- `tests/Feature/PolicyPagesTest.php`: Kiểm thử 6 test cases (5 trang + liên kết footer).

### 4.3. Kết quả Kiểm thử & Biên dịch
- `npm run build`: Hoàn thành trong 1.07s.
- `vendor/bin/pint --format agent`: Đạt 100% chuẩn PSR-12.
- `php artisan test --compact`: **100% Passed (12/12 tests, 33 assertions)**.


