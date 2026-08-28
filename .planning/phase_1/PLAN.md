# Phase 1: MiniMart Web Storefront Catalog

## Mục tiêu
Thiết lập Database schema và Domain Services cho hệ thống sản phẩm.

## Kiến trúc
- Bắt buộc tuân thủ **Anti-Fat-Controller**: Business logic được đưa vào `app/Services/ProductService.php`. Controllers chỉ nhận request, gọi service và trả về view.
- 100% tái sử dụng code Service cho Phase 2 (NativePHP Mobile App).

## Schema
1. **categories**: `id`, `name`, `slug`, `parent_id`, `description`, `is_active`
2. **products**: `id`, `category_id`, `name`, `slug`, `description`, `base_price`, `is_active`
3. **product_variants**: `id`, `product_id`, `sku`, `name`, `price`, `stock_quantity`, `is_active`

## Các task triển khai
1. Tạo Models & Migrations
2. Cập nhật DB schema
3. Viết ProductService
4. Viết ProductController, CategoryController
5. Setup routes
6. Verify & Test
