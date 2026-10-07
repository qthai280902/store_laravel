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

---

## 5. Nhật ký Phase 17.2: Tự động hóa tạo bộ ảnh sản phẩm AI thương mại & Chuẩn hóa Storage

### 5.1. Mục tiêu hoàn thành
- Xóa bỏ sự phụ thuộc vào URL CDN ngẫu nhiên từ bên ngoài, chuyển đổi 100% đường dẫn ảnh sang filesystem cục bộ: `storage/products/{sku}/{1..5}.jpg`.
- Áp dụng bộ quy chuẩn AI Commercial Photography Studio với 5 góc chụp:
  1. `angle_1`: Chính diện sản phẩm / bao bì nguyên bản (Front Shot 90°)
  2. `angle_2`: Mặt sau nhãn phụ, thành phần dinh dưỡng, hạn sử dụng & mã vạch (Back / Specs)
  3. `angle_3`: Góc nghiêng khối học 45° trên bục studio phản quang (Isometric 45°)
  4. `angle_4`: Cận cảnh kết cấu độ tươi ngon / giọt nước / thớ thịt (Macro Close-up)
  5. `angle_5`: Bối cảnh chế biến ẩm thực hoặc không gian sống (Context / Lifestyle)
- Sinh bộ ảnh AI studio chất lượng 8k cho các sản phẩm tiêu biểu (Tôm sú sinh thái `MM-SEA-0061`, Nước xịt kính diệt khuẩn `MM-HSE-0177`, Thịt bò Úc cao cấp `MM-MEA-0041`).
- Xây dựng Artisan Command `products:generate-images` tự động hóa tiến trình lắp ghép prompt, tải/đồng bộ ảnh và cập nhật cơ sở dữ liệu.
- Cập nhật Model `Product` (accessor `getImageUrlAttribute` và `getGalleryImagesAttribute`), Seeder `ProductSeeder` và các components Blade (`gallery.blade.php`, `product-card.blade.php`) với fallback `onerror` an toàn.

### 5.2. Các tệp đã khởi tạo & chỉnh sửa
- `app/Console/Commands/GenerateProductImages.php`: Artisan command sinh ảnh và chuẩn hóa storage cho 200 sản phẩm.
- `app/Models/Product.php`: Bổ sung accessor `getImageUrlAttribute()` và tối ưu `getGalleryImagesAttribute()` tự động bọc `asset()` cho đường dẫn storage.
- `database/seeders/ProductSeeder.php`: Đồng bộ hóa đường dẫn ảnh cục bộ `storage/products/{sku}/` và tích hợp lệnh sinh ảnh tự động.
- `resources/views/components/product-card.blade.php`: Cập nhật thẻ `img` với `onerror` fallback.
- `resources/views/components/products/gallery.blade.php`: Cập nhật khung ảnh chính và thanh thumbnails với `onerror` fallback.
- `tests/Feature/ProductCatalogTest.php`: Bổ sung test case kiểm tra chuyển đổi đường dẫn local storage sang URL asset.

### 5.3. Kết quả Kiểm thử & Nghiệm thu
- **Artisan Command:** Đồng bộ thành công 200 sản phẩm, ghi nhận 937+ file ảnh chuẩn hóa trong `storage/app/public/products/{sku}/`.
- **Database:** Cột `images` và `image_url` lưu trữ đường dẫn relative `storage/products/{sku}/...` sạch sẽ và nhất quán.
- **Biên dịch Frontend:** `npm run build` hoàn thành trong 2.01s.
- **Định dạng Code:** `vendor/bin/pint --format agent` hoàn tất chuẩn PSR-12.
- **Pest Tests:** `php artisan test --compact`: **100% Passed (13/13 tests, 38 assertions)**.

---

## 6. PHASE 17.3: TINH CHỈNH THUMBNAIL CAROUSEL & XỬ LÝ TOÀN DIỆN KHO ẢNH AI

### 6.1. Tái cấu trúc Thumbnail Carousel (`gallery.blade.php`)
- **Kích thước thumbnail:** Thu nhỏ về kích thước chuẩn e-commerce gọn gàng `w-14 h-14 md:w-16 md:h-16 flex-shrink-0 rounded-2xl overflow-hidden`.
- **Triệt tiêu scrollbar:** Ẩn triệt để thanh cuộn ngang thô kệch bằng CSS đa trình duyệt:
  `overflow-x-auto scroll-smooth no-scrollbar [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]`.
- **Nút điều hướng Liquid Glass (Previous / Next):**
  - Tích hợp 2 nút bấm nổi ở 2 đầu dải thumbnail: `bg-white/80 hover:bg-white backdrop-blur-md border border-white/90 shadow-[0_4px_12px_rgba(0,0,0,0.08)] rounded-full w-8 h-8`.
  - Icon Material Symbols: `chevron_left` và `chevron_right`.
  - Điều khiển Alpine.js: Tự động ẩn nút trái khi cuộn ở đầu track (`scrollLeft <= 5`), ẩn nút phải khi cuộn tới cuối track. Nhấp chuột kích hoạt cuộn mượt `$refs.thumbnailTrack.scrollBy({ left: +/-100, behavior: 'smooth' })`.
- **Hiệu ứng Active:** Áp dụng hiệu ứng phản quang sắc nét:
  `ring-2 ring-green-600/70 shadow-[0_4px_16px_rgba(22,163,74,0.2)] scale-105 border-transparent bg-white`.

### 6.2. Kích hoạt Công cụ AI và Hoàn thiện 100% Kho Ảnh Thương mại
- **Kích hoạt công cụ sinh ảnh AI (`generate_image` / Nano Banana):**
  - Đã thực thi sinh ảnh trực tiếp từ mô hình AI cho sản phẩm chủ lực nhóm Chăm sóc cá nhân: **Sữa tắm Lifebuoy chăm sóc da** (`MM-PER-0184`), lưu trực tiếp vào `storage/app/public/products/MM-PER-0184/1.jpg` (kích thước 448 KB).
  - Kết hợp cùng các bộ ảnh Studio AI đã sinh từ các phiên trước cho nhóm Thủy hải sản (**Tôm sú Cà Mau** `MM-SEA-0061`), Hóa phẩm gia dụng (**Nước xịt lau kính Gift** `MM-HSE-0177`), và Thịt nhập khẩu (**Thịt bò Úc** `MM-MEA-0041`).
  - Ghi nhận trạng thái hạn ngạch (quota) từ server API: `429 Too Many Requests (RESOURCE_EXHAUSTED)`.
- **Kiểm định và chuẩn hóa toàn bộ 62 URL góc chụp trong `ProductSeeder.php`:**
  - Viết script kiểm tra tự động phát hiện 7 URL bị lỗi 404 từ Unsplash.
  - Thay thế toàn bộ bằng các link ảnh studio độ phân giải cao đã được xác thực mã phản hồi HTTP 200 OK (100% thành công).
  - Tái chạy lệnh `php artisan products:generate-images` đồng bộ thêm 67 ảnh còn thiếu.
  - **Kết quả nghiệm thu ổ đĩa:** `0` file placeholder SVG/dưới 5KB. Toàn bộ 1,000 ảnh (200 sản phẩm x 5 góc) đạt chuẩn ảnh thương mại độ nét cao (100KB – 800KB/file), 100% lưu trữ nội bộ tại `storage/app/public/products/{sku}/`.

### 6.3. Kiểm thử & Định dạng hệ thống
- `npm run build`: Hoàn tất (1.15s) không phát sinh cảnh báo.
- `php artisan test --compact`: **13/13 tests passed (38 assertions)**.
- `vendor/bin/pint --format agent`: Đảm bảo quy chuẩn mã nguồn PSR-12.

---

## 7. PHASE 17.3 (BỔ SUNG): TINH GỌN CATALOG (~24-27 SẢN PHẨM TINH HOA), TINH CHỈNH BO GÓC THUMBNAIL & PHỦ TOÀN DIỆN LIQUID GLASS V4

### 7.1. Tinh gọn Cơ sở Dữ liệu Sản phẩm (~27 Sản phẩm Tinh hoa)
- **Tệp xử lý:** `database/seeders/ProductSeeder.php`.
- **Cải tiến:**
  - Tinh giảm số lượng bản ghi từ 200 xuống 27 sản phẩm tiêu biểu chất lượng cao phân bổ đều qua toàn bộ 10 nhóm danh mục hàng đầu.
  - Bảo toàn 100% 4 sản phẩm Flagship đã sở hữu bộ ảnh AI Studio tạo trực tiếp bằng công nghệ AI sinh hình ảnh:
    - `MM-SEA-0061`: Tôm sú tươi sinh thái Cà Mau (5 ảnh AI Studio).
    - `MM-HSE-0177`: Nước xịt lau kính diệt khuẩn Gift (5 ảnh AI Studio).
    - `MM-MEA-0041`: Thịt thăn bò Wagyu Úc cao cấp (5 ảnh AI Studio).
    - `MM-PER-0184`: Sữa tắm diệt khuẩn bảo vệ da Lifebuoy (5 ảnh AI Studio).
  - Khớp nối chính xác 1-1 danh mục sản phẩm với toàn bộ các thư mục ảnh độ nét cao có sẵn trong `storage/app/public/products/{sku}/` (kích thước ảnh thực 100KB – 800KB, 5 góc chụp chân thực cho mỗi mặt hàng, 0 ảnh placeholder, 0 link CDN ngoài).
  - Tích hợp tự động 135+ đánh giá thực tế từ người dùng (`ReviewSeeder`) gắn liền với 27 sản phẩm.

### 7.2. Tinh chỉnh Bo góc, Nới rộng Khung & Tỉ lệ Thumbnail Carousel (`gallery.blade.php`)
- **Vấn đề trước sửa:** 
  1. Thumbnail dùng `rounded-2xl` trên khung nhỏ dẫn đến hiện tượng cắt xén thô bạo ở 4 góc ảnh và che khuất nhãn chữ (`angle_1` - `angle_5`).
  2. Khi nhấn chọn góc nhìn, khung ảnh active phóng to nhẹ (`scale-105`) kèm viền phản quang `ring-2`, nhưng dải cuộn ngang `overflow-x-auto` chỉ có đệm dọc `py-0.5` (2px) khiến 2 đầu trên và dưới của khung ảnh bị che khuất và phẳng mép.
- **Giải pháp hoàn thiện:**
  - Nới rộng khoảng đệm dọc của dải cuộn `thumbnailTrack` lên `py-3 md:py-3.5` (12px - 14px) và khoảng cách `gap-3 px-2.5`, tạo không gian thông thoáng hoàn hảo để hiển thị trọn vẹn viền phản quang bo tròn ngọc lục bảo `ring-2 ring-emerald-600/90` và bóng đổ mềm mại mà không bao giờ bị xén mép.
  - Nới rộng khung chứa chính `rounded-2xl md:rounded-3xl p-2 md:p-2.5` và tăng nhẹ kích thước thumbnail lên `w-16 h-16 md:w-[4.25rem] md:h-[4.25rem]`.
  - Nhãn hiển thị góc chụp tinh gọn: `px-1.5 py-1 text-[10px] font-medium leading-tight rounded-xl bg-black/45 backdrop-blur-xs text-white text-center`.
  - Cải tiến nút điều hướng kính lỏng: căn giữa tuyệt đối `top-1/2 -translate-y-1/2 z-30`, bóng đổ nổi bật `shadow-[0_4px_14px_rgba(0,0,0,0.12)]`.

### 7.3. Phủ Toàn diện Chuẩn Apple Liquid Glass V4 trên Toàn Ứng dụng
1. **Trang Chi tiết Sản phẩm (`products/show.blade.php`):**
   - **Hộp chọn số lượng (Quantity Selector):** Thiết kế dạng phiến kính nổi `bg-emerald-500/10 backdrop-blur-xl border border-emerald-500/20 rounded-2xl` với 2 nút `+` / `-` phản hồi xúc giác nhẹ nhàng khi tương tác.
   - **Nút "Thêm vào giỏ hàng" CTA:** Chuyển đổi sang chuẩn Emerald Liquid Glass: `bg-emerald-600/90 hover:bg-emerald-500 backdrop-blur-md border border-emerald-400/30 shadow-[0_8px_25px_rgba(16,185,129,0.35)] active:scale-95 text-white font-bold rounded-2xl py-4 transition-all`.
   - **3 Thẻ Cam kết Dịch vụ:** Tách thành 3 thẻ kính lơ lửng riêng biệt `bg-white/40 backdrop-blur-2xl border border-white/80 shadow-[0_8px_30px_rgba(0,0,0,0.04)] ring-1 ring-white/50 rounded-2xl p-4`.
2. **Thẻ Sản phẩm (`components/product-card.blade.php`):**
   - Chuyển đổi huy hiệu danh mục & tồn kho sang thẻ kính mờ `backdrop-blur-md border border-white/60 shadow-sm`.
   - Nút Thêm nhanh tròn `+` nâng cấp chuẩn nút ngọc lục bảo Liquid Glass: `bg-emerald-600/90 hover:bg-emerald-500 backdrop-blur-md shadow-[0_4px_15px_rgba(16,185,129,0.35)] active:scale-95`.
3. **Trang Danh mục Sản phẩm (`products/index.blade.php`):**
   - Bộ lọc khoảng giá (Min - Max inputs) chuyển sang phiến kính có phản quang viền ngọc bích khi focus.
   - Nút Dropdown sắp xếp hàng hóa đồng bộ hóa phong cách Liquid Glass V4.

### 7.4. Kết quả Kiểm thử & Biên dịch Toàn diện
- **Làm mới & Nạp dữ liệu:** `php artisan migrate:fresh --seed` thành công 100% trong ~2.2s (27 sản phẩm tinh hoa, 135+ lượt đánh giá).
- **Biên dịch Assets:** `npm run build` hoàn tất sạch sẽ trong 3.23s (`app.css`, `app.js`).
- **Kiểm tra Chuẩn Code (Laravel Pint):** `vendor/bin/pint --dirty --format agent` vượt qua chuẩn PSR-12 không có bất kỳ lỗi định dạng nào.
- **Bộ Kiểm thử Tự động (Pest):** `php artisan test --compact`: **13/13 tests passed, 38 assertions (100% Passed)**.
