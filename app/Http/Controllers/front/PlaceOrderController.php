<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\CartList;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Payment\Stripe\StripePayment;
use Illuminate\Support\Carbon;

class PlaceOrderController extends Controller
{
    public function placeOrder(Request $request, $id){
        $userId = Auth::user()->user_id;
        $addressdata = Address::where('address_id',$id)->first();
        $addresses = Address::where('user_id',$userId)->get();
        $cartlists = CartList::with('books','variants')->where('user_id',$userId)->get();
        return view('front.HomePage.placeOrder',compact('addressdata','addresses','cartlists'));
    }

    public function store(Request $request){
        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'shipping_address_id' => $request->shippping_address_id,
            'billing_address_id' => $request->billing_address_id == null ? $request->shippping_address_id : $request->billing_address_id,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_type == 'stripe' ? 'PENDING' : 'SUCCESS',
            'total_amount' => $request->total_amount,
            'order_date' => Carbon::now()
        ]);

        $orderItem = $request->cartLists;

        foreach($orderItem as $item){
            $order_item = new OrderItem();
            $order_item->book_id = $item['product_name'];
            $order_item->quantity = $item['quantity'];
            $order_item->variant_type_id = $item['variant'];
            $order_item->price = $item['price'];
            $order_item->order_id = $order->order_id;
            $order_item->discount = '0';
            $order_item->save();
        }

        $data['url'] = "/order-list";
        if($request->payment_type == 'stripe'){
            $payment = new StripePayment();
            $data['redirectUrl'] = $payment->payment($order);
        }
        return response()->json($data);
    }
}
