<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class ProfileController extends Controller
{
    public function index(OrderService $orderService)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $orders = $orderService->getUserOrders();
        
        return view('profile.index', compact('user', 'orders'));
    }
}
