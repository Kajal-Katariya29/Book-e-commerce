<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\CartList;
use Illuminate\Support\Facades\Auth;

class PlaceOrderController extends Controller
{
    public function placeOrder(Request $request, $id){
        $addressdata = Address::where('address_id',$id)->first();
        $addresses = Address::where('user_id',Auth::user()->user_id)->get();
        $cartlists = CartList::with('books','variants')->where('user_id',Auth::user()->user_id)->get();
        return view('front.HomePage.placeOrder',compact('addressdata','addresses','cartlists'));
    }
}
