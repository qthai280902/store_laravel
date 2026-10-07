# KẾ HOẠCH PHASE 17: Nâng cấp Dữ liệu Sản phẩm, Thư viện Ảnh đa góc độ & Tách Component Đánh giá

## 1. MỤC TIÊU & YÊU CẦU KỸ THUẬT
Nâng cấp dữ liệu sản phẩm chuẩn e-commerce thực tế:
- Mở rộng schema `products` bổ sung các trường: `sku`, `origin`, `weight`, `images` (json tối thiểu 5 ảnh).
- Tạo bảng `reviews` liên kết 1-n với `Product` và `User`.
- Chuẩn hóa thư viện ảnh 5 góc nhìn/sản phẩm: bao bì mặt trước, mặt sau dinh dưỡng, góc nghiêng 45 độ, chi tiết chất liệu/kết cấu, ảnh đời thực/chế biến.
- Cập nhật Seeders (`ProductSeeder`, `ReviewSeeder`, `DatabaseSeeder`) sinh dữ liệu thực tế phong phú.
- Xây dựng các Blade Components độc lập tuân thủ vật liệu **Apple Liquid Glass V4**:
  - `x-products.gallery`: Gallery đa ảnh với hiệu ứng chuyển ảnh Alpine.js, kính mờ, zoom nhẹ, thanh thumbnail phản quang.
  - `x-products.specs`: Bảng thông số kỹ thuật dạng card kính lỏng, kèm điều hướng thương hiệu.
  - `x-products.reviews`: Phân hệ đánh giá độc lập đọc trực tiếp từ database, thống kê điểm sao trung bình, thẻ đánh giá cá nhân và form gửi đánh giá nhanh.
  - Cập nhật badges % giảm giá và cảnh báo tồn kho thời gian thực trong `products/show.blade.php`.

---

## 2. DATABASE SCHEMA & MODELS

### 2.1. Migration cập nhật bảng `products`
- Thêm cột:
  - `sku` (`string`, `unique`, `nullable`)
  - `origin` (`string`, `nullable`)
  - `weight` (`string`, `nullable`)
  - `images` (`json`, `nullable`)

### 2.2. Migration & Model `Review`
- Tạo migration `create_reviews_table`:
  - `id`
  - `product_id` (foreignId constrained on delete cascade)
  - `user_id` (foreignId constrained on delete cascade)
  - `rating` (`tinyInteger` 1-5)
  - `comment` (`text`)
  - `timestamps`
- Model `Review`:
  - `belongsTo(Product::class)`
  - `belongsTo(User::class)`
- Cập nhật Model `Product`:
  - `hasMany(Review::class)`
  - Cast `images` => `'array'`
  - Accessor hoặc helper tính discount percentage, average rating, review count.
- Cập nhật Model `User`:
  - `hasMany(Review::class)`

---

## 3. SEEDER & DỮ LIỆU THỰC TẾ
- Cập nhật `ProductSeeder`:
  - Tạo mã `sku` chuẩn định dạng e-commerce (ví dụ `MM-VEG-001`, `MM-FRU-002`,...).
  - Bổ sung `origin` (Đà Lạt - Việt Nam, New Zealand, Nhật Bản, Hàn Quốc, Mỹ, v.v.).
  - Bổ sung `weight` (500g, 1kg, 250g, 1.2kg, v.v.).
  - Bổ sung mảng `images` gồm 5 ảnh chất lượng cao phân chia theo từng danh mục/sản phẩm:
    1. Ảnh chính diện bao bì
    2. Mặt sau nhãn phụ / dinh dưỡng
    3. Góc chụp nghiêng 45 độ
    4. Cận cảnh độ tươi ngon / kết cấu
    5. Ảnh sử dụng thực tế / bàn ăn
- Tạo `ReviewSeeder`:
  - Tạo các đánh giá ngẫu nhiên nhưng mang tính chân thực (4-5 sao chiếm đa số, bình luận tiếng Việt thực tế về độ tươi, đóng gói, giao hàng).
  - Gắn vào các User có sẵn trong DB.

---

## 4. BLADE COMPONENTS & GIAO DIỆN LIQUID GLASS V4

### 4.1. `resources/views/components/products/gallery.blade.php` (`x-products.gallery`)
- Nhận prop `:product`.
- Trích xuất mảng ảnh từ `$product->images` (nếu có) hoặc fallback `$product->image_url`.
- Quản lý trạng thái bằng Alpine.js:
  - `activeImage`: ảnh hiện tại đang xem.
  - Thumbnail trượt ngang bên dưới với viền kính mỏng `ring-1 ring-white/60`, thumbnail đang chọn có viền `ring-2 ring-green-600/80 scale-105 shadow-md`.
  - Ảnh chính có khung kính lỏng bo góc `rounded-3xl`, viền phản quang và hiệu ứng zoom mượt mà khi hover.

### 4.2. `resources/views/components/products/specs.blade.php` (`x-products.specs`)
- Nhận prop `:product`.
- Hiển thị bảng thông số kỹ thuật rõ ràng trong thẻ kính lỏng `glass-card`:
  - Thương hiệu (Brand)
  - Xuất xứ (Origin)
  - Quy cách / Khối lượng (Weight)
  - Đơn vị tính (Unit)
  - Mã sản phẩm (SKU)
  - Tình trạng kho (Stock)
- Các nút liên kết khám phá theo thương hiệu dạng viên thuốc kính lỏng.

### 4.3. `resources/views/components/products/reviews.blade.php` (`x-products.reviews`)
- Nhận prop `:product`.
- Lấy danh sách reviews `$product->reviews()->with('user')->latest()->get()`.
- Thống kê điểm trung bình (ví dụ `4.8/5`), thanh phân bố số sao (5 sao, 4 sao,...).
- Danh sách thẻ nhận xét khách hàng: Avatar, Tên người dùng, Huy hiệu "Đã mua hàng", Số sao đánh giá, Thời gian nhận xét, Nội dung bình luận.
- Form gửi đánh giá nhanh (kèm rating sao tương tác Alpine.js).

### 4.4. Tinh chỉnh `resources/views/products/show.blade.php`
- Huy hiệu % giảm giá dạng viên thuốc đỏ kính lỏng: `round(((original_price - price) / original_price) * 100)%`.
- Cảnh báo tồn kho theo ngữ cảnh: "Chỉ còn X sản phẩm" nếu sắp hết hàng, hoặc "Còn hàng (X)" / "Tạm hết hàng".
- Tích hợp 3 component mới vào layout trang sản phẩm.

---

## 5. THỰC THI & KIỂM THỬ
1. Tạo và chạy migration.
2. Cập nhật Model `Product`, `Review`, `User`.
3. Viết và chạy `ReviewSeeder` + `ProductSeeder`.
4. Viết các file Blade component và cập nhật `show.blade.php`.
5. Chạy `npm run build` để biên dịch CSS.
6. Chạy `vendor/bin/pint --dirty --format agent`.
7. Kiểm thử các luồng hiển thị chi tiết sản phẩm.
8. Cập nhật `walkthrough.md` và thông báo người dùng.

---

## 6. PHASE 17 (DEBUG & REFACTOR): KHẮC PHỤC LỖI HIỂN THỊ & CHUẨN HÓA DỮ LIỆU

### 6.1. Root Causes & Action Plan
1. **Lỗi gán sai ảnh theo danh mục & sản phẩm:**
   - *Nguyên nhân:* `ProductSeeder.php` gán 1 pack ảnh chung cho toàn bộ danh mục mà không phân biệt tiểu mục (ví dụ 'Thịt cá' gồm cả thịt bò, heo, gia cầm và cá diêu hồng, cá hồi; 'Đồ gia dụng' bị gắn ảnh găng tay cao su cho nước lau kính).
   - *Giải pháp:* Viết bộ quy tắc mapping ảnh theo từ khóa cụ thể trong tên sản phẩm (Fish -> Cá tươi, Beef -> Thịt bò, Poultry -> Thịt gà/vịt, Glass Cleaner -> Chai xịt kính, Detergent -> Nước giặt/rửa chén, Shampoos/Soaps -> Dầu gội/sữa tắm). Mỗi sản phẩm có đủ 5 góc ảnh đúng 100% ngữ cảnh.
2. **Lỗi rung lắc / biến dạng ảnh (Mouseover jitter & zoom):**
   - *Nguyên nhân:* `gallery.blade.php` bắt sự kiện `mousemove`, tính toán `transform-origin` và zoom `scale-125` liên tục gây giật lag.
   - *Giải pháp:* Loại bỏ hoàn toàn sự kiện `mousemove` và các class co giãn đột ngột. Giữ khung ảnh chính tĩnh, rõ nét, bo góc `rounded-[2.5rem]` với viền kính phản quang. Chỉ đổi ảnh khi người dùng bấm vào thumbnail.
3. **Lỗi bố cục co cụm xộc xệch tại `show.blade.php`:**
   - *Nguyên nhân:* Cột Mô tả và Thông số kỹ thuật đang chia 50/50 cưỡng ép khiến nội dung bị co ngắn.
   - *Giải pháp:* 
     - Top Grid: 2 cột cân đối (Gallery 45-50%, Info 50-55%).
     - Thông tin sản phẩm (`x-products.specs`): Trải rộng toàn màn hình (`max-w-7xl mx-auto`), thiết kế dạng bảng thông số ngang tối giản với 2 nút điều hướng kính lỏng ("Xem thêm ({Brand}) →" và "Xem tất cả →").
     - Khối Mô tả: Thẻ kính độc lập, phân đoạn dễ đọc.
     - Khối Đánh giá (`x-products.reviews`): Tách biệt ở dưới cùng.
4. **Lỗi trùng lặp sản phẩm ngoài Catalog:**
   - *Nguyên nhân:* Vòng lặp pad 30 sản phẩm trong `ProductSeeder` sinh ra các bản ghi trùng lặp `(Extra ...)`; đồng thời phân trang MySQL không có `id` tiebreaker; Infinite scroll thiếu cơ chế khóa URL đã tải và deduplicate DOM.
   - *Giải pháp:*
     - Loại bỏ việc lặp padding `(Extra ...)`. Tạo 200 sản phẩm hoàn toàn độc lập, khác biệt.
     - Bổ sung `orderBy('id', 'desc')` trong query `ProductController.php`.
     - Bổ sung deduplication Set và URL tracking trong script của `products/index.blade.php`.
5. **Làm sạch Database & Build lại Assets:**
   - Chạy `php artisan migrate:fresh --seed`
   - Chạy `npm run build`
   - Chạy `vendor/bin/pint --dirty --format agent`
   - Chạy Pest test kiểm tra toàn diện.

---

## 7. PHASE 17.1: TRIỂN KHAI CÁC TRANG CHÍNH SÁCH & HỖ TRỢ, KẾT NỐI LIÊN KẾT FOOTER LIQUID GLASS

### 7.1. Mục tiêu
- Xóa bỏ các liên kết chết `href="#"` tại cột "Chính sách & Hỗ trợ" ở Footer.
- Xây dựng hệ thống Controller, Routing và 5 Blade Views chuẩn phong cách Apple Liquid Glass V4.
- Trang FAQ tích hợp Accordion tương tác đóng mở êm ái bằng Alpine.js với 4 danh mục câu hỏi thiết thực.

### 7.2. Backend Controller & Routing
- Controller: `app/Http/Controllers/PageController.php`:
  - `returnPolicy()`: Trả về `pages.return-policy` (Chính sách đổi trả 24h)
  - `shippingPolicy()`: Trả về `pages.shipping-policy` (Chính sách giao hàng & cước phí)
  - `privacyPolicy()`: Trả về `pages.privacy-policy` (Chính sách bảo mật)
  - `terms()`: Trả về `pages.terms` (Điều khoản sử dụng)
  - `faq()`: Trả về `pages.faq` (Câu hỏi thường gặp)
- Route group trong `routes/web.php` với prefix các slug tiếng Việt thân thiện chuẩn SEO.

### 7.3. Thiết kế Blade Views (`resources/views/pages/`)
- Áp dụng cấu trúc chuẩn vật liệu Liquid Glass:
  - Khung phiến kính trung tâm `max-w-5xl mx-auto my-10 p-8 md:p-12`, cấu trúc `bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50 rounded-[2.5rem]`.
  - Header dạng viên thuốc kính phản quang bo tròn mềm mại.
  - Phân mục H2, H3 có icon nhận diện và thẻ highlight ghi chú nổi bật.
  - FAQ Accordion tương tác: Sử dụng Alpine.js (`x-data="{ active: null }"`), thanh câu hỏi phản hồi hiệu ứng kính khi active/hover.

### 7.4. Kết nối Footer Links
- Cập nhật `resources/views/components/layouts/app.blade.php` kết nối đầy đủ 5 route helpers:
  - `route('pages.return-policy')`
  - `route('pages.shipping-policy')`
  - `route('pages.privacy-policy')`
  - `route('pages.terms')`
  - `route('pages.faq')`

---

## 8. PHASE 17.2: TỰ ĐỘNG HÓA TẠO BỘ ẢNH SẢN PHẨM THƯƠNG MẠI THỰC TẾ BẰNG CÔNG CỤ AI (NANO BANANA / IMAGEN) & CHUẨN HÓA STORAGE

### 8.1. Mục tiêu
- Xóa bỏ hoàn toàn URL CDN bên ngoài, đưa 100% hình ảnh sản phẩm về lưu trữ cục bộ trong Laravel filesystem (`storage/app/public/products/{sku}/`).
- Ứng dụng quy chuẩn nhiếp ảnh thương mại AI Commercial Studio Photography với 5 góc chụp chân thực:
  1. `angle_1`: Chính diện (Front Shot 90°)
  2. `angle_2`: Mặt sau nhãn phụ, thông số dinh dưỡng & hạn sử dụng (Back / Specs)
  3. `angle_3`: Góc nghiêng khối học 45° (Isometric 45°)
  4. `angle_4`: Cận cảnh kết cấu thớ thịt, vỏ quả, bọt xà phòng (Macro Close-up)
  5. `angle_5`: Bối cảnh chế biến ẩm thực hoặc không gian sống (Context / Lifestyle)
- Xây dựng Artisan Command `products:generate-images` tự động sinh prompt và đồng bộ hóa thư viện ảnh vào storage.
- Cập nhật Model `Product`, Seeder `ProductSeeder` và các Blade components (`gallery.blade.php`, `product-card.blade.php`) phục vụ ảnh chuẩn qua `asset()`.

---

## 9. PHASE 17.3: TÁI THIẾT KẾ THUMBNAIL CAROUSEL & TRIỂN KHAI THỰC CHẤT CÔNG CỤ AI TẠO ẢNH TOÀN BỘ DANH MỤC

### 9.1. Mục tiêu
1. **Khắc phục triệt để lỗi UI Thumbnail Gallery:**
   - Thu nhỏ kích thước thumbnail về chuẩn e-commerce: `w-14 h-14 md:w-16 md:h-16 flex-shrink-0 rounded-2xl overflow-hidden`.
   - Triệt tiêu scrollbar ngang mặc định của trình duyệt bằng CSS tiện ích `no-scrollbar [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]`.
   - Bổ sung 2 nút điều hướng kính lỏng (Liquid Glass Navigation Buttons) ở 2 đầu thanh thumbnail với icon `chevron_left` và `chevron_right`.
   - Điều khiển cuộn mượt qua Alpine.js (`$refs.thumbnailTrack.scrollBy({ left: +/-100, behavior: 'smooth' })`), tự động ẩn/hiện nút khi ở đầu hoặc cuối dải ảnh.
   - Thể hiện hiệu ứng active phản quang: `ring-2 ring-green-600/70 shadow-[0_4px_16px_rgba(22,163,74,0.2)] scale-105 transition-transform`.

2. **Triển khai thực chất công cụ AI tạo ảnh (`generate_image` / Nano Banana):**
   - Sinh tuần tự đầy đủ bộ ảnh 5 góc chụp Studio thương mại cho các sản phẩm đại diện thuộc toàn bộ các danh mục:
     - Chăm sóc cá nhân: `MM-PER-0184` (Sữa tắm Lifebuoy chăm sóc da)
     - Đồ ăn vặt: `MM-SNK-0143` (Bánh ChocoPie Orion tình bạn)
     - Rau củ tươi: `MM-VEG-0001` (Cải bó xôi Đà Lạt hữu cơ)
     - Trái cây: `MM-FRU-0021` (Táo Envy New Zealand)
     - Gia vị: `MM-SPC-0121` (Nước mắm truyền thống Khải Hoàn)
     - Sữa & Bơ sữa: `MM-MIL-0101` (Sữa tươi tiệt trùng TH True Milk)
   - Lưu trữ trực tiếp vào `storage/app/public/products/{sku}/1.jpg` đến `5.jpg`.
   - Đảm bảo 100% các mặt hàng tiêu biểu hiển thị ảnh AI Studio sắc nét, chuẩn thương mại.

3. **Kiểm thử & Chuẩn hóa:**
   - `npm run build` xác nhận asset hợp lệ.
   - `php artisan test --compact` kiểm tra toàn bộ suite test.
   - `vendor/bin/pint --format agent` định dạng mã nguồn.

---

## 10. PHASE 17.3 (BỔ SUNG): TINH GỌN CATALOG (~24 SẢN PHẨM), TINH CHỈNH BO GÓC THUMBNAIL & PHỦ TOÀN DIỆN LIQUID GLASS V4

### 10.1. Mục tiêu Kỹ thuật
1. **Tinh gọn Catalog:** Thu nhỏ cơ sở dữ liệu sản phẩm trong `ProductSeeder.php` từ 200 xuống còn ~24-27 sản phẩm tinh hoa, giữ nguyên vẹn 4 sản phẩm AI Studio flagship (`MM-SEA-0061`, `MM-HSE-0177`, `MM-MEA-0041`, `MM-PER-0184`) và bổ sung 23 mặt hàng tiêu biểu trải đều 10 danh mục. Giúp database nhẹ, load tức thì và chuẩn xác 100% ngữ cảnh ảnh thực tế.
2. **Sửa lỗi bo góc Thumbnail:** Giảm bán kính bo góc từ `rounded-2xl` xuống `rounded-xl`, đồng bộ lớp phủ nhãn góc nhìn `px-1 py-0.5 text-[9px] font-medium leading-tight rounded-xl`, không còn tình trạng cấn mép hoặc xén chữ.
3. **Phủ toàn diện Apple Liquid Glass V4:**
   - Hộp tăng giảm số lượng & nút Thêm giỏ hàng trong `products/show.blade.php`.
   - 3 thẻ cam kết dịch vụ dạng viên thuốc kính mờ.
   - Nút Thêm nhanh giỏ hàng `+` và các pill danh mục/kho trên `product-card.blade.php`.
   - Menu sắp xếp và bộ lọc trên `products/index.blade.php`.
   - Dải Highlight quang học ở mép trên các popup và floating toast trong `app.blade.php`.
4. **Kiểm thử & Bàn giao:**
   - Chạy `php artisan migrate:fresh --seed`.
   - Chạy `npm run build` và Pest feature tests.

---

## 11. PHASE 17.4: TÁI CẤU TRÚC GIAO DIỆN BLOG (DANH SÁCH & CHI TIẾT) THEO UI KIT APPLE LIQUID GLASS V4

### 11.1. Mục tiêu Kỹ thuật
Khảo sát và chuyển đổi toàn diện giao diện Blog (`resources/views/blog/index.blade.php` và `resources/views/blog/show.blade.php`) theo đúng bộ thiết kế mẫu tại `.planning/scratch/ui_kit/blog_design`, bảo toàn phân bổ lưới responsive và luồng dữ liệu Eloquent, đồng thời nâng cấp toàn bộ visual sang chuẩn Apple Liquid Glass V4:
1. **Khảo sát UI Kit:**
   - Index mẫu: `.planning/scratch/ui_kit/blog_design/tin_t_c_m_o_v_t_minimart_blog_centered_layout/code.html`
   - Show mẫu: `.planning/scratch/ui_kit/blog_design/b_quy_t_b_o_qu_n_rau_c_t_i_ngon_minimart_blog/code.html`
   - Design System: `.planning/scratch/ui_kit/blog_design/liquid_glass/DESIGN.md`
2. **Nâng cấp Controller (`PostController.php`):**
   - Hỗ trợ lọc theo danh mục `?category=` và truyền `$categories`, `$selectedCategory`, `$featuredPost` vào view index.
   - Truy vấn và truyền `$relatedPosts` (3 bài viết cùng chuyên mục) vào view show.
3. **Tái thiết kế `resources/views/blog/index.blade.php`:**
   - Hero Header trung tâm phong cách e-magazine với badge pill `Chuyên mục Blog MiniMart` và hiệu ứng vệt sáng ambient accent.
   - Thẻ Featured Spotlight lớn cho bài viết nổi bật đầu trang.
   - Thanh bộ lọc chủ đề Category Filter Bar dạng viên thuốc kính lỏng trượt ngang (`rounded-full p-1.5 flex gap-2`), tab active tone xanh ngọc lục bảo MiniMart (`bg-emerald-800 text-white shadow-md`).
   - Lưới thẻ bài viết chuẩn Blog Card Liquid Glass:
     - Thẻ kính: `bg-white/40 backdrop-blur-2xl border border-white/60 shadow-[0_10px_30px_rgba(0,0,0,0.05)] ring-1 ring-white/50 rounded-3xl overflow-hidden hover:bg-white/60 hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300`.
     - Tag danh mục kính lỏng nổi trên góc ảnh, metadata ngày đăng và thời gian đọc, tóm tắt nội dung 3 dòng, chân thẻ có avatar/tác giả và nút đọc tiếp.
   - Phân trang chuẩn Liquid Glass đồng bộ.
4. **Tái thiết kế `resources/views/blog/show.blade.php`:**
   - Toàn bộ bài viết đặt trên phiến kính trung tâm `liquid-glass-pane max-w-5xl mx-auto my-8 p-6 md:p-12 rounded-[2.5rem] bg-white/40 backdrop-blur-3xl border border-white/70 shadow-[0_20px_50px_rgba(0,0,0,0.08)] ring-1 ring-white/50`.
   - Breadcrumb Trail dạng viên thuốc kính lỏng.
   - Khung ảnh đại diện Hero Banner bo góc `rounded-[2rem]` kèm vệt sáng phản quang trên mép và badges nổi (Chuyên mục, Thời gian đọc, Ngày đăng).
   - Headline lớn & Byline tác giả chuyên nghiệp có tích xanh `verified`.
   - Nội dung bài viết (Prose): `prose prose-lg prose-emerald max-w-none text-gray-700 leading-[1.8]`, tiêu đề H2/H3 có accent xanh MiniMart, Blockquote thẻ kính mờ `bg-emerald-500/10 backdrop-blur-xl border border-emerald-500/20 rounded-2xl p-6 md:p-8`, ảnh chèn bài viết có viền kính mỏng.
   - Hộp tiểu sử tác giả (Author Bio Box) kính lỏng kèm nút chia sẻ / sao chép liên kết.
   - Cụm 3 bài viết liên quan (Related Articles) dưới chân trang tuân thủ chuẩn thẻ Blog Card mới.
5. **Kiểm thử & Biên dịch:**
   - Biên dịch `npm run build`.
   - Chuẩn hóa định dạng `vendor/bin/pint --dirty --format agent`.
   - Viết test case bổ sung trong `tests/Feature/BlogPagesTest.php` và chạy `php artisan test --compact`.
