<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

class OrderListController extends Controller
{
    public function orders(){
        $orders = Order::where('user_id',Auth::user()->user_id)->get();
        return view('front.HomePage.orderList',compact('orders'));
    }

    public function orderDetail(Request $request, $id){
        $orderItems = OrderItem::where('order_id',$id)->with('book.bookMedia','varianttype','order')->get();
        $order = Order::where('order_id',$id)->with('billingAddress','billingAddress')->first();
        // dd($order);
        // dd($orderItems);
        return view('front.HomePage.orderDetailPage',compact('orderItems','order'));
    }
}
