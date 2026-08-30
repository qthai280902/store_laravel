# MỤC TIÊU PHASE 15_1
Bổ sung widget giỏ hàng trôi nổi, hoàn thiện phân quyền trên Dashboard, thêm ruy băng trạng thái cho hệ thống cửa hàng, tích hợp cuộn vô hạn (Infinite Scroll) kết hợp Scroll Reveal cho danh sách sản phẩm và tinh chỉnh hiệu ứng chuyển động vật lý cho Dropdown danh mục. Tất cả tuân thủ nghiêm ngặt nguyên lý Apple Liquid Glass V4.

## Kế hoạch thực thi
1. **Widget Giỏ hàng trôi nổi**:
   - Chỉnh sửa `app.blade.php`, thêm nút Giỏ hàng trôi nổi góc dưới bên phải với Badge số lượng, áp dụng hiệu ứng kính lỏng.
2. **Account Dashboard (`profile/index.blade.php`)**:
   - Thêm nhãn "Khách hàng" ở giao diện.
   - Thêm AOS Scroll Reveal Animations.
3. **Hệ thống cửa hàng (`stores.blade.php`)**:
   - Thêm Ruy băng "Tạm đóng cửa" bằng CSS ở góc phải của chi nhánh đầu tiên.
4. **Infinite Scroll & Scroll Reveal (`products/index.blade.php`)**:
   - Bỏ nút "Xem thêm sản phẩm", dùng `x-intersect` của Alpine để trigger hàm fetch sản phẩm mới.
   - Thêm AOS `data-aos="fade-up"` cho card sản phẩm.
5. **Hiệu ứng vật lý Dropdown (`home.blade.php`)**:
   - Bổ sung các transition class `opacity-0 -translate-y-4 scale-[0.98]` khi Enter và Leave.
