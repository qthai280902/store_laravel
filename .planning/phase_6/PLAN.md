# Phase 6: Tái cấu trúc Dữ liệu: Siêu thị Thực phẩm Nông sản - Kế hoạch Thực thi

## 1. Mục tiêu
Thay thế toàn bộ dữ liệu hiện tại (thời trang, thẻ game, v.v.) bằng tập dữ liệu nông sản, thực phẩm đặc trưng để đồng bộ với nhận diện thương hiệu "MiniMart - Siêu thị thực phẩm nông sản", đồng thời đảm bảo hình ảnh (placeholder) tương thích hoàn hảo với tone màu Liquid Glass.

## 2. Chi tiết công việc (Sửa file)

### [MODIFY] `database/seeders/CategorySeeder.php`
- **Xóa:** 'Thời trang Nam', 'Thực phẩm & Tiện ích', 'Thẻ cào & Dịch vụ'.
- **Thêm mới:**
  - `Rau củ hữu cơ`
  - `Trái cây nhập khẩu`
  - `Thực phẩm tươi sống`
  - `Thực phẩm khô & Đóng gói`

### [MODIFY] `database/seeders/ProductSeeder.php`
- **Xóa:** Toàn bộ data array cũ.
- **Thêm mới (Data Array):**
  - Danh mục `Rau củ hữu cơ`: Cải bó xôi Đà Lạt (25,000đ), Cà chua Cherry (45,000đ).
  - Danh mục `Trái cây nhập khẩu`: Nho mẫu đơn (450,000đ).
  - Danh mục `Thực phẩm tươi sống`: Thịt bò Úc (350,000đ).
  - Danh mục `Thực phẩm khô & Đóng gói`: Mì cay kimchi Hàn Quốc (35,000đ).
- **Cập nhật URL Ảnh (Liquid Glass tone):** 
  Thay đoạn URL cũ thành:
  `'https://placehold.co/600x400/F5F5F5/00490e?text=' . urlencode($name)`

### [MODIFY] `database/seeders/ProductVariantSeeder.php`
- Cập nhật logic sinh `ProductVariant` để xử lý ngoại lệ cho mặt hàng "Mì cay kimchi Hàn Quốc":
  - **Mì cay kimchi Hàn Quốc:** Sẽ có 3 bản ghi variant: `Cấp độ 3`, `Cấp độ 4`, `Cấp độ 5`.
  - **Các sản phẩm còn lại:** Giữ nguyên 1 bản ghi variant `Mặc định`.

## 3. Quản lý Nhật ký (Kỷ luật Phase 6)
- File `PLAN.md` hiện tại được lưu ở `.planning/phase_6/PLAN.md`.
- File `walkthrough.md` sẽ được khởi tạo trong `.planning/phase_6/` để ghi nhận toàn bộ log lỗi và command (nếu có) khi chạy `php artisan migrate:fresh --seed`.
