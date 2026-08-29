# Phase 13: Sửa lỗi Glassmorphism Homepage, Tái cấu trúc Header & Xây dựng trang About/Stores

## 1. Tái cấu trúc Header & Phân vùng Chức năng
- **Xóa bỏ Hamburger Icon**: Loại bỏ icon SVG 3 gạch thừa thãi. Thay thế bằng chữ "MENU" với class `font-bold text-gray-800 tracking-wider hover:text-green-700` tạo sự mạnh mẽ, hiện đại.
- **Phân tách bằng Divider**: Nhóm "Đăng nhập / Đăng ký" và "MENU" vào cùng một Flex container, tách nhau bởi một dải phân cách xám (`<div class="h-5 w-px bg-gray-300 mx-4"></div>`). 
- **Căn chỉnh hoàn hảo**: Đảm bảo toàn bộ nhóm liên kết nằm thẳng hàng ngang tuyệt đối bằng `flex items-center`.

## 2. Khôi phục Khung Liquid Glass Khung Cha (Homepage)
- Đã xóa toàn bộ background xanh lỳ (`bg-green-800`) ở Layer 0 của 3 section (Sản phẩm mới, Sản phẩm nổi bật, Flash Sales) trên trang chủ.
- Áp dụng cấu trúc kính mờ trong suốt (Liquid Glass) vào Layer 0: `bg-white/40 backdrop-blur-2xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl`.
- Đổi màu text tiêu đề (Tên danh mục) thành màu xanh đậm `text-green-900` (thay vì trắng) để nổi bật rõ ràng, thanh lịch trên lớp kính mờ.

## 3. Khởi tạo Trang Tĩnh (Giới thiệu & Hệ thống cửa hàng)
- **Tích hợp Routing tĩnh**: Bổ sung `Route::view` cho 2 trang `about` và `stores` tại `routes/web.php`.
- **Trang Giới thiệu (About)**: Tạo layout tĩnh nội dung Tiếng Việt (Sứ mệnh, Tầm nhìn, Cam kết) lồng bên trong một container bo góc Liquid Glass thanh lịch.
- **Trang Hệ thống cửa hàng (Stores)**: Triển khai 3 thẻ chi nhánh giả lập (Quận 1, Quận 3, Quận 7). Sử dụng CSS Grid `grid-cols-1 md:grid-cols-3` đi kèm hiệu ứng hover nổi nhẹ (translate-y) và bóng đổ (shadow-2xl).
- Cập nhật menu Sub-Nav để trỏ liên kết đến 2 trang này thành công.

## 4. Biên dịch tài nguyên
- Đã chạy `npm run build` để Tailwind render và nén toàn bộ các class tiện ích mới xuất hiện ở 2 file view tĩnh.
