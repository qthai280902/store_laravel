# Phase 11: Tái cấu trúc UI/UX: Header, Product Card, Mini-Cart Toast và Homepage Layout

## 1. Cập nhật Database & Seeder (`products` table)
- **Migration & Model**: Bổ sung cột `brand`, `original_price`, `unit` và `is_featured` vào bảng `products`. Đã đưa vào mảng `$fillable` của model.
- **ProductSeeder**: Cập nhật logic tạo dữ liệu để tự động sinh ngẫu nhiên `brand` (VD: VietGAP, Vissan, ...), `unit` (đ/kg, đ/túi 500g, ...), và `original_price` (tạo ra giá gạch bỏ cao hơn giá gốc). Tính năng sản phẩm nổi bật (`is_featured`) cũng được sinh ngẫu nhiên (tỷ lệ 20%).

## 2. Fix Alignment Header (`app.blade.php`)
- Nút "Đăng nhập / Đăng ký" trên header đã được canh giữa hoàn hảo với biểu tượng sử dụng các class Flexbox (`flex items-center justify-center gap-2`). Kích thước icon chuẩn `w-6 h-6`.

## 3. Cơ chế Mini-Cart Toast (Alpine.js)
- Thêm mã logic cho một Popup Toast thông báo mỗi khi người dùng thêm sản phẩm vào giỏ hàng thành công.
- Tích hợp sử dụng Fetch API vào `product-card.blade.php` thay cho việc nộp thẻ `<form>` thông thường. Fetch gửi yêu cầu bằng Ajax, không tải lại trang và kích hoạt sự kiện `$dispatch('cart-added', {...})`.
- Toast lắng nghe sự kiện và hiển thị thông tin sản phẩm, đơn giá, và có nút "Xem giỏ" + "Thanh toán". Tự động ẩn sau 4 giây.

## 4. Tái thiết kế Product Card (`product-card.blade.php`)
- Đã loại bỏ hoàn toàn khối hiển thị Đánh giá (Rating stars) để giao diện thoáng hơn.
- Thêm nhãn **Thương hiệu** (`brand`) ở góc dưới hình ảnh.
- Cấu trúc giá hiện đại hóa: Hiển thị giá hiện tại và đơn vị kế bên (VD: `180,000đ / kg`). Phía trên là giá gốc gạch bỏ.

## 5. Mở rộng Homepage (`home.blade.php` & `HomeController.php`)
- `HomeController` giờ đây đã tải 3 nhóm sản phẩm riêng biệt thay vì 1 nhóm như trước:
  - `$newProducts`: Sản phẩm mới nhất.
  - `$featuredProducts`: Sản phẩm nổi bật ngẫu nhiên (có tỷ lệ `is_featured`).
  - `$flashSales`: Khuyến mãi chớp nhoáng (ngẫu nhiên).
- Trên trang chủ `home.blade.php`, chúng tôi thay thế "Khuyến mãi Hot" bằng 3 cụm Grid được bao bọc trong khối **Liquid Glass** container (`bg-white/40 backdrop-blur-md...`). Giao diện vô cùng sang trọng và bắt mắt.

---

### Cập nhật dữ liệu
Hãy chạy lệnh sau để làm mới cơ sở dữ liệu và thử nghiệm các tính năng mới:
```bash
php artisan migrate:fresh --seed
```
