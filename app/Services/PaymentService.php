<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    public function createMoMoPayment(Order $order)
    {
        $endpoint = env('MOMO_ENDPOINT', 'https://test-payment.momo.vn/v2/gateway/api/create');
        $partnerCode = env('MOMO_PARTNER_CODE', 'MOMO_MOCK');
        $accessKey = env('MOMO_ACCESS_KEY', 'MOCK');
        $secretKey = env('MOMO_SECRET_KEY', 'MOCK');

        $orderId = $order->id.'_'.time();
        $orderInfo = 'Thanh toan don hang #'.$order->id;
        $amount = (string) $order->total_amount;
        $redirectUrl = route('profile');
        $ipnUrl = route('payment.momo-webhook');
        $extraData = '';
        $requestId = time().'';
        $requestType = 'captureWallet';

        $rawHash = 'accessKey='.$accessKey.
            '&amount='.$amount.
            '&extraData='.$extraData.
            '&ipnUrl='.$ipnUrl.
            '&orderId='.$orderId.
            '&orderInfo='.$orderInfo.
            '&partnerCode='.$partnerCode.
            '&redirectUrl='.$redirectUrl.
            '&requestId='.$requestId.
            '&requestType='.$requestType;

        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => 'MiniMart',
            'storeId' => 'MiniMart',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
        ];

        // Mock the HTTP call if it's test environment or mock keys
        if ($partnerCode === 'MOMO_MOCK') {
            $order->update(['transaction_id' => $orderId, 'payment_status' => 'paid']); // Mock instant success
            session()->flash('success', 'Mock MoMo: Đã thanh toán giao dịch thành công (Test)');

            return $redirectUrl;
        }

        $response = Http::post($endpoint, $data);
        $result = $response->json();

        if (isset($result['payUrl'])) {
            $order->update(['transaction_id' => $orderId]);

            return $result['payUrl'];
        }

        throw new \Exception('MoMo API Error: '.json_encode($result));
    }

    public function verifyMoMoWebhook(array $data)
    {
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $rawHash = 'accessKey='.$accessKey.
            '&amount='.$data['amount'].
            '&extraData='.$data['extraData'].
            '&message='.$data['message'].
            '&orderId='.$data['orderId'].
            '&orderInfo='.$data['orderInfo'].
            '&orderType='.$data['orderType'].
            '&partnerCode='.$data['partnerCode'].
            '&payType='.$data['payType'].
            '&requestId='.$data['requestId'].
            '&responseTime='.$data['responseTime'].
            '&resultCode='.$data['resultCode'].
            '&transId='.$data['transId'];

        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        if ($signature !== $data['signature']) {
            return false;
        }

        // Update Order
        $realOrderId = explode('_', $data['orderId'])[0];
        $order = Order::find($realOrderId);
        if ($order) {
            if ($data['resultCode'] == 0) {
                $order->update(['payment_status' => 'paid']);
            } else {
                $order->update(['payment_status' => 'failed']);
            }
        }

        return true;
    }
}
