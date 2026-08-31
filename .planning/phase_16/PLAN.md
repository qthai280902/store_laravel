# KẾ HOẠCH PHASE 16: Khởi tạo hệ thống Admin và Tích hợp Kiến trúc UI Admin Liquid Glass V4

## 1. Khảo sát & Phân tích UI Kit
- Đọc `master_layout_template_minimart/code.html`
- Đọc `liquid_glass/DESIGN.md` và `liquid_logic_admin/DESIGN.md`

## 2. Thiết lập Kiến trúc Backend
- Xây dựng Middleware `CheckAdminRole`.
- Khởi tạo Route Group với prefix `/admin` trong `routes/web.php`.
- Khởi tạo `AdminController` để xử lý logic Dashboard.
- Cập nhật Auth để điều hướng Admin login.

## 3. Khởi tạo Master Layout & Components
- Tạo `resources/views/layouts/admin.blade.php`.
- Chia nhỏ: `x-admin.sidebar`, `x-admin.topbar`.
- Áp dụng vật liệu Kính lỏng (Liquid Glass V4): `backdrop-blur-*`, `bg-white/x`, `shadow-inner`.

## 4. Triển khai Màn hình Cốt lõi
- Admin Login (`login_minimart_admin_liquid_glass/code.html`)
- Admin Dashboard (`t_ng_quan_minimart_admin_liquid_glass/code.html`)
