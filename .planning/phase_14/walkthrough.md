# Phase 14: Đại tu UI: Overlapping Layout, Active State, Map Stores & Infinite Scroll

## 1. Fix Tận gốc Khung Overlapping & Liquid Glass (Homepage)
- Thiết kế lại cấu trúc 3 section (Sản phẩm mới, Sản phẩm nổi bật, Flash Sales) bằng HTML theo tỉ lệ khung tràn lề mới.
- Khung Banner Layer 0 được sử dụng thẻ `rounded-t-3xl` và kéo giãn độ sâu đáy.
- Grid Sản phẩm Layer 1 bọc hiệu ứng Liquid Glass (`bg-white/40 backdrop-blur-2xl`) lồng đè lên 50% Layer 0, cắt đi khối thừa bằng `rounded-b-3xl`. 

## 2. Bổ sung Active State & "Trang chủ" (Header)
- Khôi phục link "Trang chủ" vào thanh Sub-nav (Mega menu row).
- Xây dựng hệ thống Active State tự động (sử dụng toán tử điều kiện `request()->routeIs(...)`). Các tab tương ứng (Trang chủ, Blog, Giới thiệu, Cửa hàng, Danh mục sản phẩm) sẽ tự động in đậm và tô sáng màu xanh `text-green-800` khi người dùng đang đứng ở trang đó.

## 3. Nâng cấp Hệ thống Cửa hàng (Google Maps Integration)
- Khai báo Alpine.js `x-data="{ activeStore: 1 }"` tại `stores.blade.php`.
- Tách trang ra thành thiết kế 2 cột Split-view: 
  - Trái: Khung iframe Google Maps tương tác thực tế hiển thị tọa độ bản đồ cho 3 chi nhánh. Chuyển đổi khung bản đồ dựa vào biến state.
  - Phải: Accordion danh sách cửa hàng. Khi `@click` vào thẻ bất kỳ, hiệu ứng glassmorphism chuyển đậm hơn (`border-green-500 shadow-xl`), thẻ nội dung đổ xuống thông tin chi tiết và Maps nhấp nháy cập nhật tọa độ tương ứng.

## 4. Tối ưu Product Card & Gỡ Phân trang
- Chỉnh nút Thêm vào giỏ hàng (`+`) trên thẻ Product Card về định dạng icon vuông vức, cân đối (`w-8 h-8 rounded-lg flex items-center justify-center`). Style này đồng bộ cho cả nút xanh (Còn hàng) và xám (Hết hàng).
- **Tạm thời đóng block phân trang (`$products->links()`)** tại `products/index.blade.php` bằng HTML comment. Việc thiết lập Infinite Scroll (Cuộn tự động) sẽ được xử lý logic JS và Controller ở Phase tiếp theo. 
