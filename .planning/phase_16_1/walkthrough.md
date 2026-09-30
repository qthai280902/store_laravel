# BƯỚC ĐI (WALKTHROUGH) PHASE 16_1: Hoàn thiện chức năng phân hệ Hồ sơ người dùng

## 1. Mục tiêu thực hiện
- Chuyển đổi các thành phần tĩnh của trang Profile sang các luồng nghiệp vụ động hoàn chỉnh.
- Xây dựng các API/Route cho cập nhật thông tin, đổi mật khẩu, upload avatar, đăng xuất.
- Áp dụng các thành phần giao diện Liquid Glass V4 cho modal đổi mật khẩu, form input, và toast thông báo.

## 2. Công việc đã thực hiện

### 2.1. Backend & Routing
- Đã kết nối symlink lưu trữ: `php artisan storage:link`.
- Đã bổ sung các route cho phân hệ Profile trong `routes/web.php`:
  - `PUT /profile/update` (`profile.update`)
  - `PUT /profile/password` (`profile.password.update`)
  - `POST /profile/avatar` (`profile.avatar.update`)
  - `POST /logout` (`logout`)
- Đã triển khai đầy đủ các phương thức nghiệp vụ trong `app/Http/Controllers/ProfileController.php`:
  - `update()`: Validate và cập nhật `name`, `phone`, `dob`, `gender`, `address`.
  - `updatePassword()`: Kiểm tra mật khẩu hiện tại với rule `current_password`, validate mật khẩu mới tối thiểu 8 ký tự và xác nhận `confirmed`, băm mật khẩu mới qua `Hash::make()`.
  - `updateAvatar()`: Validate file ảnh (jpeg, png, jpg, webp tối đa 2MB), xóa file ảnh cũ trong storage (nếu có), lưu file mới vào `storage/app/public/avatars` và cập nhật đường dẫn avatar vào cơ sở dữ liệu. Hỗ trợ cả AJAX JSON response và redirect session thông thường.

### 2.2. Giao diện & Tương tác Liquid Glass V4 (`resources/views/profile/index.blade.php`)
- **Avatar Uploader**: Bọc ảnh đại diện trong form upload tương tác. Khi hover hiển thị lớp phủ mờ Liquid Glass kèm icon máy ảnh `photo_camera`. Chọn ảnh sẽ kích hoạt FileReader preview ngay lập tức trên UI và tự động submit form.
- **Form Cập nhật thông tin**: Chuyển thành form `PUT`, điền sẵn dữ liệu `old()` kết hợp dữ liệu từ User model, áp dụng vật liệu input Liquid Glass với `shadow-inner` và viền bóng nổi, tích hợp thông báo lỗi validate trực quan.
- **Modal Đổi mật khẩu**: Thiết kế modal chuẩn Apple Liquid Glass V4 (`bg-white/60 backdrop-blur-3xl border border-white/80 shadow-[0_25px_60px_rgba(0,0,0,0.18)]`), có vệt phản quang ánh sáng ở mép trên (`highlight line`). Tích hợp tự động mở lại modal nếu có lỗi validate mật khẩu.
- **Modal Quản lý Địa chỉ**: Thêm modal kính lỏng cho phép người dùng xem/sửa địa chỉ giao hàng chi tiết và số điện thoại liên hệ.
- **Floating Toast Notification**: Hiển thị thanh thông báo nổi hình viên thuốc lơ lửng góc trên bên phải khi có `session('success')` hoặc `session('error')`, tự động mờ và đóng sau 4 giây.
- **Đăng xuất an toàn**: Đảm bảo form POST kèm `@csrf` token hoạt động chuẩn xác ở sidebar.
