# Kế hoạch Thực thi Phase 4: Fix dứt điểm Layout, Tối ưu Tìm kiếm & Nạp Dữ liệu thực tế

Phase 4 nhằm khắc phục dứt điểm các sự cố hiển thị về Layout Grid, đồng thời nâng cấp tính năng Advanced Search và làm sạch dữ liệu hệ thống (loại bỏ Faker).

## 1. Rà soát & Cố định Layout (Bug Fixes)
Mặc dù ở thao tác trước tôi đã fix Layout, nhưng trong Phase này, tôi sẽ tiến hành kiểm tra chéo (cross-check) lại toàn bộ để cam kết tuân thủ 100% `DESIGN.md`:
- **`resources/views/products/index.blade.php` & `resources/views/home.blade.php`:**
  - Kiểm tra class bọc vòng lặp phải chính xác là `<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">`.
  - Phải được bọc trong container `max-w-[1200px] mx-auto px-4 md:px-6`.
- **`resources/views/components/product-card.blade.php`:**
  - Đảm bảo thẻ `<x-product-card>` có class `w-full` và ảnh bên trong `<img>` có class `object-cover`.

## 2. Nâng cấp Tìm kiếm & Lọc (Advanced Search)
- **`app/Services/ProductService.php`:**
  - Mở rộng logic `getProducts()` để tìm kiếm chính xác (Search by Name/Description) và có khả năng kết hợp Lọc theo `category_id`.
- **`app/Http/Controllers/ProductController.php`:**
  - Viết logic trả về cho UI Search Results.
- **`resources/views/products/search.blade.php` [NEW]:**
  - Xây dựng trang kết quả tìm kiếm với cụm từ khóa hiển thị rõ: "Kết quả tìm kiếm cho: {keyword}".
  - Kế thừa cấu trúc Grid chuẩn như Catalog.
- **`resources/views/components/layouts/app.blade.php`:**
  - Gắn tag `<form>` action GET trỏ tới URL Search vào thanh Search Bar trên Top Navigation.

## 3. Nạp Dữ liệu thực tế (Realistic Seeding)
Xóa bỏ thư viện Faker rác, thay thế bằng dữ liệu thật như sếp yêu cầu.
- **`database/seeders/CategorySeeder.php`:**
  - Thay thế các danh mục cũ bằng 2 danh mục chính xác: `Thời trang Nam` và `Thực phẩm & Tiện ích`.
- **`database/seeders/ProductSeeder.php`:**
  - Nhóm "Thời trang Nam": Áo thun cotton cổ tròn Local Brand, Quần short linen casual, Áo thun graphic Anime/Manga.
  - Nhóm "Thực phẩm & Tiện ích": Mì cay Hàn Quốc, Hạt khô cho chó size lớn (nhập sỉ sll), Kính mát đổi màu chống ánh sáng xanh.
  - Ảnh minh họa sẽ gán đồng loạt thành chuẩn: `https://placehold.co/600x400/F5F5F5/333333?text=Product`.

## 4. Open Questions & Review
- **Yêu cầu phê duyệt:** Vui lòng xác nhận danh sách các file tôi dự định can thiệp ở trên đã đủ và chính xác với ý đồ của Sếp chưa. Nếu sếp "Proceed" (Đồng ý), tôi sẽ bắt tay vào code ngay lập tức.
