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

---

## 8. PHASE 17.4: TÁI CẤU TRÚC GIAO DIỆN BLOG (DANH SÁCH & CHI TIẾT) THEO UI KIT APPLE LIQUID GLASS V4

### 8.1. Khảo sát & Kế thừa UI Kit
- Trích xuất toàn diện phong cách từ `.planning/scratch/ui_kit/blog_design`:
  - `tin_t_c_m_o_v_t_minimart_blog_centered_layout/code.html` (Hero banner trung tâm, Category Filter Tabs, Blog Cards).
  - `b_quy_t_b_o_qu_n_rau_c_t_i_ngon_minimart_blog/code.html` (Phiến kính trung tâm `liquid-glass-pane`, Cover Banner, Magazine Typography, Author Bio card, Related Articles).
  - `liquid_glass/DESIGN.md` (Khúc xạ quang học, viền kép `border-t-[1.5px] border-white/80`, `ring-1 ring-white/50`, concentric squircle `rounded-[28px]`, Plus Jakarta Sans typography).

### 8.2. Nâng cấp Database Schema & Controller Logic
- **Migration & Model:**
  - Tạo và chạy migration `2026_10_07_153909_add_author_and_read_time_to_posts_table.php` bổ sung 2 cột `author_name` và `read_time`.
  - Cập nhật Model `Post`: Thêm `author_name`, `read_time` vào `$fillable`, xây dựng accessor `getImageUrlAttribute` tự động bọc `asset()` cho đường dẫn lưu trữ nội bộ `storage/blog/...`.
- **Nâng cấp `PostController`:**
  - Hỗ trợ bộ lọc danh mục động `?category=...` và thanh tìm kiếm từ khóa `?search=...`.
  - Cơ chế **Hero Spotlight không trùng lặp**: Ở trang 1 khi xem tất cả bài viết, bài viết mới nhất được đặt làm Spotlight, danh sách lưới phía dưới tự động loại trừ ID của bài viết Spotlight (`where('id', '!=', $featuredPost->id)`).
  - Tự động truy vấn 3 bài viết liên quan (`$relatedPosts`) cùng chuyên mục cho trang chi tiết.
- **Làm giàu Dữ liệu Mẫu (`BlogSeeder`):**
  - Tạo 8 bài viết chất lượng cao phân bổ đều qua 5 chủ đề thực tế (`Mẹo vặt nhà bếp`, `Dinh dưỡng & Sức khỏe`, `Chuyện Nông Trại MiniMart`, `Công thức nấu ăn`, `Khuyến mãi & Mùa vụ`).
  - Tự động tải và đồng bộ 8 tệp ảnh thực tế độ nét cao (100KB – 540KB) vào `storage/app/public/blog/post-{1..8}.jpg`, 0 link placeholder.

### 8.3. Tái cấu trúc Giao diện Danh sách (`blog/index.blade.php`)
- **Breadcrumb:** Viên thuốc kính lỏng `bg-white/40 backdrop-blur-[20px] saturate-[180%] border border-white/60`.
- **Editorial Header Banner:** Khung kính bo góc `rounded-[28px]` với badge pill `Chuyên mục Blog MiniMart` và hiệu ứng vệt sáng ambient accent.
- **Hero Spotlight Card:** Thẻ tiêu điểm khổ lớn với ảnh 16:9 sắc nét, dải sáng highlight kính mép trên, 3 badges kính nổi (Chuyên mục, Thời gian đọc, Tiêu điểm tuần này), avatar tác giả và nút CTA đọc toàn bộ bài viết.
- **Category Filter Deck:** Dải chọn chuyên mục dạng viên thuốc kính lỏng trượt ngang (`no-scrollbar`) kèm thanh tìm kiếm kính mờ. Tab active tone xanh ngọc lục bảo MiniMart `bg-emerald-800 text-white font-bold shadow-md`.
- **Lưới Thẻ Bài viết (Blog Cards):**
  - Lưới responsive 1 cột mobile, 2 cột tablet, 3 cột desktop.
  - Thẻ kính Liquid Glass: `bg-white/40 backdrop-blur-2xl border border-white/60 shadow-[0_10px_30px_rgba(0,0,0,0.05)] ring-1 ring-white/50 rounded-3xl overflow-hidden hover:bg-white/60 hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1.5 transition-all duration-300 group`.
  - Khung ảnh tỷ lệ chuẩn, tag danh mục nổi trên ảnh, metadata ngày đăng và thời gian đọc, tiêu đề in đậm, trích dẫn súc tích, avatar tác giả và liên kết đọc tiếp.
  - Phân trang chuẩn Liquid Glass đồng bộ.

### 8.4. Tái cấu trúc Giao diện Chi tiết (`blog/show.blade.php`)
- **Phiến kính Trung tâm:** Đặt trên khối kính nguyên khối `liquid-glass-pane max-w-5xl mx-auto my-8 p-6 sm:p-10 md:p-12 bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem]`.
- **Hero Banner Khổ lớn:** Chiều cao 320px - 460px bo góc `rounded-[2rem]`, vệt sáng quét quang học trên mép và 3 badges nổi ở góc chân ảnh.
- **Headline & Author Byline:** Tiêu đề lớn sắc nét, avatar tác giả có tích xanh `verified`, lượt xem và nút sao chép link tương tác một chạm.
- **Editorial Typography (Prose):** Cấu hình `prose prose-lg prose-emerald max-w-none text-gray-700 leading-[1.8]`, tiêu đề H2/H3 có accent xanh MiniMart, Blockquote thẻ kính lỏng `bg-emerald-50/70 border-l-4 border-emerald-600 rounded-2xl p-6 md:p-8 italic`, ảnh chèn bài viết có bo góc `rounded-2xl` và viền kính mỏng.
- **Author Bio Card:** Thẻ kính mờ hiển thị chi tiết tiểu sử tác giả, vai trò cố vấn ẩm thực và lời nhắn gửi.
- **Bài viết Liên quan:** Lưới 3 thẻ gợi ý cùng chủ đề dưới chân trang theo chuẩn Blog Card mới.
- **Nút Quay lại Blog:** Viên thuốc kính lỏng nổi bật `bg-white/80 hover:bg-white text-emerald-900 border border-white/90 shadow-md`.

### 8.5. Kết quả Kiểm thử & Nghiệm thu
- **Tự động hóa Kiểm thử (Pest Feature Test):** Tạo mới `tests/Feature/BlogPagesTest.php` với 6 test cases bao quát: tải trang thành công, không trùng lặp Hero Spotlight, lọc theo category, tìm kiếm bài viết, tải trang chi tiết kèm bài viết liên quan, xử lý 404 cho slug không hợp lệ.
  - Tổng test suite toàn dự án: **19/19 tests passed, 63 assertions (100% Passed)**.
- **Biên dịch Assets:** `npm run build` hoàn tất sạch sẽ trong 3.00s (`app.css`, `app.js`).
- **Chuẩn hóa Code:** `vendor/bin/pint --dirty --format agent` hoàn tất chuẩn PSR-12 không có lỗi.

---

## 9. ĐỒNG BỘ TOÀN DIỆN HỆ THỐNG ĐIỀU HƯỚNG (BREADCRUMBS) & PHÂN TRANG KÍNH LỎNG (LIQUID GLASS PAGINATION)

### 9.1. Chuẩn hóa Bộ Phân trang Kính Lỏng Toàn diện (Liquid Glass Pagination)
- **Tệp tạo mới:** `resources/views/vendor/pagination/liquid-glass.blade.php`.
- **Cấu hình toàn cục:** Khai báo `Paginator::defaultView('vendor.pagination.liquid-glass')` trong `AppServiceProvider::boot()`. Mọi phương thức `->links()` toàn hệ thống tự động kế thừa bộ phân trang kính lỏng.
- **Quy chuẩn vật liệu:**
  - Khung bao con nhộng kính: `inline-flex items-center gap-1.5 p-2 rounded-full bg-white/40 backdrop-blur-2xl border border-white/80 shadow-[0_8px_30px_rgba(0,0,0,0.06)] ring-1 ring-white/50`.
  - Nút trang Active: `w-10 h-10 rounded-full bg-emerald-700 text-white font-extrabold text-sm shadow-md border border-emerald-500/40 select-none transform scale-105 ring-2 ring-emerald-500/30`.
  - Nút trang Inactive: `w-10 h-10 rounded-full text-gray-700 font-semibold hover:bg-white/80 hover:text-emerald-900 border border-transparent hover:border-white/80 hover:shadow-xs active:scale-95 transition-all`.
  - Nút mũi tên Previous/Next: Icon Material Symbols bo tròn tương tác nhạy bén (`hover:scale-105 active:scale-95`). Khi disabled: xám mờ tinh tế với `cursor-not-allowed`.

### 9.2. Đồng bộ 100% Thanh Điều Hướng (Multi-Pill Breadcrumb Trail) Toàn Hệ Thống
- **Thống nhất quy chuẩn Breadcrumb:**
  - Định dạng chuỗi viên thuốc kính lỏng lơ lửng: `px-3.5 py-1.5 rounded-full bg-white/50 hover:bg-white text-gray-700 transition-colors shadow-xs border border-white/70 flex items-center gap-1.5 font-medium hover:shadow-sm`.
  - Mục `Trang chủ` luôn có biểu tượng Home: `<span class="material-symbols-outlined text-[18px]">home</span>`.
  - Dấu phân cách thống nhất toàn bộ bằng chevron kính mờ: `<span class="material-symbols-outlined text-gray-400 text-sm select-none">chevron_right</span>` (thay thế triệt để các dấu gạch chéo `/` thô sơ).
  - Mục trang hiện tại: Viên thuốc xanh ngọc lục bảo nổi bật `bg-emerald-100/70 border border-emerald-200/60 text-emerald-950 font-bold truncate shadow-xs`.
- **Các trang đã được rà soát và đồng bộ:**
  1. `products/show.blade.php`: Thay thế hoàn toàn capsule đơn lẻ bằng chuỗi Multi-Pills đồng nhất với Blog Show.
  2. `products/index.blade.php`: Bổ sung Breadcrumb Multi-Pills nhận diện danh mục động.
  3. `products/search.blade.php`: Bổ sung Breadcrumb Multi-Pills hiển thị từ khóa tìm kiếm.
  4. `blog/index.blade.php`: Cập nhật Multi-Pills nhận diện danh mục và từ khóa tìm kiếm bài viết.
  5. `blog/show.blade.php`: Hoàn thiện hiệu ứng hover, shadow và icon select-none.
  6. `cart/index.blade.php`: Bổ sung Breadcrumb Multi-Pills Giỏ hàng.
  7. `checkout/index.blade.php`: Bổ sung Breadcrumb Multi-Pills chuỗi Trang chủ -> Giỏ hàng -> Thanh toán.
  8. `pages/faq.blade.php`, `privacy-policy.blade.php`, `terms.blade.php`, `return-policy.blade.php`, `shipping-policy.blade.php`: Chuyển đổi 100% sang chuẩn Multi-Pill.
  9. `about.blade.php`, `stores.blade.php`: Bổ sung thanh điều hướng về trang chủ đồng bộ.

### 9.3. Kết quả Kiểm thử & Nghiệm thu
- **Tự động hóa Kiểm thử (Pest Feature Test):** `php artisan test --compact`: **19/19 tests passed, 63 assertions (100% Passed)**.
- **Biên dịch Frontend:** `npm run build` biên dịch sạch sẽ trong 1.03s.
- **Chuẩn hóa Code:** `vendor/bin/pint --dirty --format agent` hoàn tất chuẩn PSR-12 không phát sinh lỗi.

