<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Hiển thị trang Chính sách đổi trả 24h.
     */
    public function returnPolicy(): View
    {
        return view('pages.return-policy');
    }

    /**
     * Hiển thị trang Chính sách giao hàng & cước phí.
     */
    public function shippingPolicy(): View
    {
        return view('pages.shipping-policy');
    }

    /**
     * Hiển thị trang Chính sách bảo mật dữ liệu.
     */
    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy');
    }

    /**
     * Hiển thị trang Điều khoản sử dụng dịch vụ.
     */
    public function terms(): View
    {
        return view('pages.terms');
    }

    /**
     * Hiển thị trang Câu hỏi thường gặp (FAQ).
     */
    public function faq(): View
    {
        return view('pages.faq');
    }
}
