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
use Payment as GlobalPayment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        $orderId = $request->get('order_id');
        if($sessionId){
            Payment::where('session_id',$sessionId)->update([
                'status' => 'success',
            ]);
        }
        else{
            throw new NotFoundHttpException();
        }

        if($orderId){
            Order::where('order_id',$orderId)->update([
                'payment_status' => 'SUCCESS',
            ]);
        }

        return view('front.HomePage.paymentSuccess');
    }


    public function cancel(Request $request){

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

