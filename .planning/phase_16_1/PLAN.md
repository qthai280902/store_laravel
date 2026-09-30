# KẾ HOẠCH PHASE 16_1: Hoàn thiện toàn diện chức năng và tương tác phân hệ Hồ sơ người dùng

## 1. MỤC TIÊU & YÊU CẦU
Rà soát và chuyển đổi toàn bộ các thành phần tĩnh, form chưa kích hoạt trong phân hệ Hồ sơ người dùng (`/profile`) thành các luồng nghiệp vụ hoàn chỉnh:
- Cập nhật thông tin cá nhân (Họ tên, SĐT, Ngày sinh, Giới tính, Địa chỉ)
- Upload avatar với FileReader preview trực tiếp và lưu trữ vào `storage/app/public/avatars`
- Modal đổi mật khẩu (Alpine.js) với kiểm tra mật khẩu hiện tại và mã hóa mật khẩu mới
- Đăng xuất an toàn qua POST + CSRF token
- Modal / tương tác thêm địa chỉ và phương thức thanh toán
- Hệ thống Floating Glass Toast phản hồi trạng thái hành động (thành công / lỗi) chuẩn Apple Liquid Glass V4.

---

## 2. KIẾN TRÚC BACKEND & ROUTING

### 2.1. Routes (`routes/web.php`)
```php
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```

### 2.2. Controller Logic (`app/Http/Controllers/ProfileController.php`)
- `update(Request $request)`:
  - Validate: `name` (required|string|max:255), `phone` (nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10), `dob` (nullable|date|before:today), `gender` (nullable|in:Nam,Nữ,Khác), `address` (nullable|string|max:500).
  - Cập nhật thông tin vào tài khoản đang đăng nhập `auth()->user()`.
  - Flash session `success`.
- `updatePassword(Request $request)`:
  - Validate: `current_password` (required|current_password), `password` (required|min:8|confirmed).
  - Cập nhật mật khẩu bằng `Hash::make()` vào tài khoản.
  - Flash session `success`.
- `updateAvatar(Request $request)`:
  - Validate: `avatar` (required|image|mimes:jpeg,png,jpg,webp|max:2048).
  - Xóa file avatar cũ nếu tồn tại trong `storage/app/public/avatars/`.
  - Lưu file mới vào thư mục `avatars` trên disk `public`.
  - Cập nhật trường `avatar` của user thành đường dẫn tương đối (hoặc storage URL).
  - Flash session `success` (hoặc JSON response nếu dùng AJAX/tải trang).

---

## 3. THIẾT KẾ GIAO DIỆN & TƯƠNG TÁC LIQUID GLASS V4 (`resources/views/profile/index.blade.php`)

### 3.1. Avatar Uploader
- Bọc avatar trong `<form>` và `<label>` liên kết với `<input type="file" name="avatar" class="hidden">`.
- Hover overlay kính mờ kèm camera icon (`bg-black/30 backdrop-blur-md opacity-0 hover:opacity-100 transition-all duration-300`).
- Alpine.js preview ảnh ngay khi người dùng chọn file và tự động gửi form (hoặc có nút xác nhận nhanh).

### 3.2. Form Cập nhật thông tin cá nhân
- Cấu hình thẻ `<form method="POST" action="{{ route('profile.update') }}">` kèm `@csrf` và `@method('PUT')`.
- Áp dụng chuẩn vật liệu Liquid Input: `bg-white/70 backdrop-blur-md border-2 border-white/80 shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] rounded-2xl px-6 py-4 text-gray-900 outline-none focus:bg-white focus:ring-2 focus:ring-green-500 transition-all`.
- Hiển thị lỗi validation (`$errors`) một cách tinh tế.

### 3.3. Modal Đổi mật khẩu (Liquid Glass Modal)
- Quản lý trạng thái bằng Alpine.js (`passwordModal: false`).
- Backdrop kính mờ sâu (`bg-black/25 backdrop-blur-md`).
- Hộp thoại kính: `bg-white/70 backdrop-blur-3xl border border-white/80 shadow-[0_25px_60px_rgba(0,0,0,0.18)] ring-1 ring-white/60 rounded-[2.5rem] p-8 w-full max-w-md relative overflow-hidden`.
- Các input: Mật khẩu hiện tại, Mật khẩu mới, Xác nhận mật khẩu mới.

### 3.4. Modal / Tương tác Quản lý Địa chỉ & Phương thức thanh toán
- Thiết kế modal Thêm địa chỉ mới chuẩn kính lỏng.
- Hỗ trợ popup thông báo trạng thái phương thức thanh toán.

### 3.5. Hệ thống Phản hồi (Floating Glass Toast)
- Hiển thị toast thông báo nổi góc trên bên phải khi `session('success')` hoặc `session('error')` xuất hiện.
- Tự động mờ dần và ẩn sau 4 giây qua Alpine.js.

---

## 4. KẾ HOẠCH KIỂM THỬ VÀ HOÀN THIỆN
1. Chạy `php artisan storage:link` (Đã hoàn thành).
2. Kiểm thử form cập nhật thông tin cá nhân.
3. Kiểm thử tải lên avatar & xem trước.
4. Kiểm thử chức năng đổi mật khẩu (bao gồm validate mật khẩu sai & đúng).
5. Kiểm thử nút đăng xuất qua phương thức POST có CSRF.
6. Chạy `npm run build` và Pint formatting cho PHP.
7. Cập nhật `walkthrough.md`.
