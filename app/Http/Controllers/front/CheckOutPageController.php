<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartList;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckOutRequest;

class CheckOutPageController extends Controller
{
    public function checkOut(){
        $userId = Auth::user()->user_id;
        $carts = CartList::where('user_id',$userId)->get();
        $addressdata = Address::where('user_id',$userId)->get();
        return view('front.HomePage.checkOutPage',compact('carts','addressdata'));
    }

    public function createEdit($id){
        if(!empty($id)){
            $addressData = Address::where('address_id',$id)->first();
        }
        return response()->json(['success' => true, 'addressData' => $addressData]);
    }

    public function store(CheckOutRequest $request)
    {
        $address =  Address::create($request->only(['first_name','last_name','phone_number','email_id','address','country','city','state','pincode','user_id']));
        $addressdata = Address::where('address_id',$address->address_id)->first();
        return view('front.HomePage.placeOrder',compact('addressdata'));
    }

    public function update(CheckOutRequest $request){
        $data = $request->all();
        $address = Address::find($request->id)->update($data);
        $addressdata = Address::where('address_id',$request->id)->first();
        return view('front.HomePage.placeOrder',compact('addressdata'));
    }

    public function delieverAddress(){
        return response()->json(['success' => 'true']);
    }
}
