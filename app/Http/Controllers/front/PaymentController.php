<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    public function payment(Request $request, $id){

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $orders = OrderItem::where('order_id',$id)->with('book')->get();
        $lineItems = [];
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach($orders as $order){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $order->book->name,
                    ],
                    'unit_amount_decimal' => $order->price,
                ],
                'quantity' => $order->quantity,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success', [] , true) . "?session_id={CHECKOUT_SESSION_ID}",
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

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        if($sessionId){
            payment::where('session_id',$sessionId)->update([
                'status' => 'success',
            ]);
        }
        else{
            throw new NotFoundHttpException();
        }

        return view('front.HomePage.paymentSuccess');
    }


    public function cancel(){

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        if($sessionId){
            payment::where('session_id',$sessionId)->update([
                'status' => 'failed',
            ]);
        }

        else{
            throw new NotFoundHttpException();
        }

        return view('front.HomePage.paymentCancel');
    }
}

