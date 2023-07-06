<?php

namespace App\Services\Payment\Stripe;

use App\Models\Order;
use App\Models\OrderItem;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Models\Payment;

class StripePayment{

    protected $strippayment;

    public function __construct(){
        Stripe::setApiKey(config('constants.STRIPE_SECRET_KEY'));
    }

    public function payment(Order $order){
        $lineItems = [];
        foreach($order->orderItems as $value){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $value->book->name,
                    ],
                    'unit_amount_decimal' => $value->price,
                ],
                'quantity' => $value->quantity,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success', [] , true) . "?session_id={CHECKOUT_SESSION_ID}&order_id={$order->order_id}",
            'cancel_url' => route('payment.cancel'),
        ]);

        $request = [
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success', [] , true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.cancel'),
        ];

        $payment = new Payment();
        $payment->session_id = $session->id;
        $payment->request = json_encode($request);
        $payment->response = json_encode($session);
        $payment->status = 'pending';
        $payment->save();

        return ($session->url);
    }
}
