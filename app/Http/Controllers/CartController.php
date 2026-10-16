<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        if ($request->has('items') && is_array($request->items)) {
            $request->validate([
                'items' => 'required|array',
                'items.*.variant_id' => 'required|exists:product_variants,id',
                'items.*.quantity' => 'nullable|integer|min:1',
            ]);

            $addedCount = 0;
            foreach ($request->items as $item) {
                if (! empty($item['variant_id'])) {
                    $this->cartService->add($item['variant_id'], $item['quantity'] ?? 1);
                    $addedCount++;
                }
            }

            return redirect()->back()->with('success', 'Đã thêm '.$addedCount.' sản phẩm combo vào giỏ hàng!');
        }

        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $this->cartService->add($request->variant_id, $request->quantity ?? 1);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, $variantId)
    {
        $this->cartService->update($variantId, $request->quantity);

        return redirect()->route('cart.index');
    }

    public function remove($variantId)
    {
        $this->cartService->remove($variantId);

        return redirect()->route('cart.index');
    }
}
