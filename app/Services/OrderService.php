<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function placeOrder($data)
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            throw new \Exception('Cart is empty');
        }

        return DB::transaction(function () use ($data, $cart) {
            $order = Order::create([
                'user_id' => auth()->id() ?? null,
                'shipping_address' => $data['address'],
                'payment_method' => $data['payment_method'] ?? 'cod',
                'payment_status' => 'pending',
                'total_amount' => $this->cartService->getTotal(),
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $this->cartService->clear();

            return $order;
        });
    }

    public function getUserOrders()
    {
        return Order::with('items')->where('user_id', auth()->id())->latest()->get();
    }
}
