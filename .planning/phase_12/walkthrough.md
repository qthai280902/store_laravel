# Phase 12: Tái cấu trúc Layout Homepage, Header và Logic Tồn kho

## 1. Cập nhật Database & Logic Tồn Kho (Stock)
- **Migration & Model**: Đã tạo migration mới để bổ sung cột `stock` (integer, mặc định = 10) vào bảng `products`. Đã thêm `stock` vào mảng `$fillable` của model `Product`.
- **ProductSeeder**: Cập nhật vòng lặp tạo sản phẩm để sinh ngẫu nhiên số lượng tồn kho `stock` từ 0 đến 50, đảm bảo cơ sở dữ liệu có các sản phẩm bị "Hết hàng".
- **Giao diện Product Card (`product-card.blade.php`)**:
  - Khi sản phẩm hết hàng (`stock == 0`): Toàn bộ thẻ bị làm mờ đi 50% (`opacity-50`). Badge chuyển sang màu đỏ chữ đỏ ("Hết hàng"). Nút "Thêm vào giỏ" bị xám đi và chặn hành động click (hiển thị alert thông báo hết hàng bằng Alpine.js).
  - Khi còn hàng: Nút "+" đổi sang hình vuông bo góc (`rounded-lg`) và sử dụng dải màu `bg-green-600` tươi mới.

## 2. Dọn dẹp & Ép khoảng cách Header (`app.blade.php`)
- Giảm padding trục dọc của Top Bar (Header) xuống chỉ còn `py-2`.
- Đã XÓA HOÀN TOÀN icon Giỏ hàng ra khỏi thanh Header (giỏ hàng sẽ được truy cập qua thanh menu offcanvas hoặc các liên kết khác).
- Nút "Đăng nhập / Đăng ký" (hoặc "Tài khoản" khi đã đăng nhập) được làm sạch sẽ, gỡ bỏ icon SVG và chỉ hiển thị dưới dạng văn bản (text thuần).

## 3. Dọn dẹp màu khối "Tại sao chọn MiniMart" (`home.blade.php`)
- Cập nhật lại màu sắc vòng tròn bọc icon ở phần đặc quyền: Nền chuyển sang màu xanh nhạt `bg-green-100` và các icon sử dụng màu xanh đậm `text-green-700`, tạo nên sự đồng nhất với thương hiệu MiniMart.

## 4. Áp dụng Overlapping Layout cho Homepage (`home.blade.php`)
- Thiết kế mới tạo ra cấu trúc khung lồng đè lên nhau (Overlapping) cho cả 3 phân mục: "Sản phẩm mới", "Sản phẩm nổi bật" và "Flash Sales".
- **Cấu trúc HTML**:
  - Khung cha: Một banner nổi bật (chiều cao `h-64`) với nền `bg-green-800`, bo góc 2xl.
  - Khung con: Một container nổi (âm margin `-mt-32`), sử dụng hiệu ứng bóng kính Liquid Glass (`bg-white/70 backdrop-blur-lg`) chứa lưới Grid của sản phẩm đè lên trên khung cha 50% diện tích. Mang lại chiều sâu và cảm giác hiện đại hơn rất nhiều so với lưới ngang bình thường.

---

### Hướng dẫn chạy kiểm thử
Vui lòng chạy dòng lệnh dưới đây để tạo lại bảng dữ liệu mới có chứa cột `stock` ngẫu nhiên và kiểm tra logic "Hết hàng":
```bash
php artisan migrate:fresh --seed
```
