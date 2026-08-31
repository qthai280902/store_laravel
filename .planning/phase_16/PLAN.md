# Phase 16: Tái cấu trúc UI - Đưa nội dung lên phiến Liquid Glass

## MỤC TIÊU
Tái cấu trúc bố cục hiển thị của các trang nội dung chính (Danh sách sản phẩm, Chi tiết sản phẩm, Blog, Giới thiệu). Đưa toàn bộ khối nội dung đặt lên một phiến kính khổng lồ duy nhất mang vật liệu Liquid Glass, thay vì thả nổi trên nền hoặc sử dụng các card phân mảnh. Phải tuân thủ tuyệt đối quy tắc: TRANSPARENT + DEPTH + REFRACTION + HIGHLIGHT + MATERIAL RESPONSE.

## KẾ HOẠCH THỰC THI
1. **app.css**: Thêm utility class `.liquid-glass-pane`.
2. **app.blade.php**: Cập nhật background của `body` sang dạng dải màu gradient phức tạp để kính có thể khúc xạ.
3. **Refactor Views**: Cập nhật các file:
   - `products/index.blade.php`
   - `products/show.blade.php`
   - `blog/index.blade.php`
   - `blog/show.blade.php`
   - `about.blade.php`
   Bọc toàn bộ nội dung trong class `liquid-glass-pane max-w-7xl mx-auto px-6 py-10 my-8`. Đảm bảo các thành phần bên trong phân tầng vật liệu (Layered Glass).
4. **Build**: Chạy `npm run build`
