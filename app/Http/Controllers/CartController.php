<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'integer|min:1',
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
