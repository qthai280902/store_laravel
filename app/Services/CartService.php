<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function add($variantId, $quantity = 1)
    {
        $cart = $this->getCart();
        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $quantity;
        } else {
            $variant = ProductVariant::with('product')->findOrFail($variantId);
            $cart[$variantId] = [
                'id' => $variant->id,
                'product_id' => $variant->product->id,
                'name' => $variant->product->name.' - '.$variant->name,
                'price' => $variant->price,
                'image_url' => $variant->product->image_url,
                'quantity' => $quantity,
            ];
        }
        Session::put('cart', $cart);
    }

    public function update($variantId, $quantity)
    {
        $cart = $this->getCart();
        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] = max(1, $quantity);
            Session::put('cart', $cart);
        }
    }

    public function remove($variantId)
    {
        $cart = $this->getCart();
        unset($cart[$variantId]);
        Session::put('cart', $cart);
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public function clear()
    {
        Session::forget('cart');
    }
}
