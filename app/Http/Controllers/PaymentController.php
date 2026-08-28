<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function momoWebhook(Request $request)
    {
        try {
            $isValid = $this->paymentService->verifyMoMoWebhook($request->all());

            if ($isValid) {
                return response()->json(['message' => 'success'], 200);
            }

            return response()->json(['message' => 'Invalid signature'], 400);
        } catch (\Exception $e) {
            Log::error('MoMo Webhook Error: '.$e->getMessage());

            return response()->json(['message' => 'Internal server error'], 500);
        }
    }
}
