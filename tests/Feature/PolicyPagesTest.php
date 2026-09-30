<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders return policy page successfully', function () {
    $response = $this->get(route('pages.return-policy'));

    $response->assertStatus(200);
    $response->assertSee('Chính Sách Đổi Trả 24 Giờ');
    $response->assertSee('1900 1234');
});

it('renders shipping policy page successfully', function () {
    $response = $this->get(route('pages.shipping-policy'));

    $response->assertStatus(200);
    $response->assertSee('Chính Sách Vận Chuyển & Giao Hàng', false);
    $response->assertSee('Miễn Phí Giao Hàng Cho Đơn Từ 300.000đ');
});

it('renders privacy policy page successfully', function () {
    $response = $this->get(route('pages.privacy-policy'));

    $response->assertStatus(200);
    $response->assertSee('Chính Sách Bảo Mật Thông Tin');
    $response->assertSee('Bảo Vệ Quyền Riêng Tư Tuyệt Đối');
});

it('renders terms of service page successfully', function () {
    $response = $this->get(route('pages.terms'));

    $response->assertStatus(200);
    $response->assertSee('Điều Khoản Sử Dụng Dịch Vụ');
    $response->assertSee('Thỏa Thuận Người Dùng');
});

it('renders faq page with accordion successfully', function () {
    $response = $this->get(route('pages.faq'));

    $response->assertStatus(200);
    $response->assertSee('Câu Hỏi Thường Gặp (FAQ)');
    $response->assertSee('Làm thế nào để đặt mua thực phẩm tại MiniMart?');
});

it('has correct policy links in footer on home page', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee(route('pages.return-policy'));
    $response->assertSee(route('pages.shipping-policy'));
    $response->assertSee(route('pages.privacy-policy'));
    $response->assertSee(route('pages.terms'));
    $response->assertSee(route('pages.faq'));
});
