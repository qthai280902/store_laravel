<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout()
    {
        return view('checkout.index');
    }

    public function place(Request $request, PaymentService $paymentService)
    {
        $request->validate([
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,momo,credit_card',
        ]);

        $order = $this->orderService->placeOrder($request->all());

        if ($request->payment_method === 'momo') {
            try {
                $payUrl = $paymentService->createMoMoPayment($order);

                return redirect()->away($payUrl);
            } catch (\Exception $e) {
                return redirect()->route('checkout.index')->withErrors(['error' => 'Lỗi tạo thanh toán MoMo: '.$e->getMessage()]);
            }
        }

        return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');
    }

    public function success($orderId)
    {
        $order = Order::with('items.productVariant.product')->findOrFail($orderId);

        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    public function account()
    {
        $orders = $this->orderService->getUserOrders();

        return view('account.orders.index', compact('orders'));
    }
}
