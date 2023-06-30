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
        $carts = CartList::where('user_id',Auth::user()->user_id)->get();
        $addressdata = Address::where('user_id',Auth::user()->user_id)->get();
        return view('front.HomePage.checkOutPage',compact('carts','addressdata'));
    }

    public function createEdit($id = null){
        $addressData = null;
        if(!empty($id)){
            $addressData = Address::where('address_id',$id)->first();
        }
        return response()->json(['success' => true, 'addressData' => $addressData]);
    }

    public function store(CheckOutRequest $request)
    {
        Address::create($request->only(['first_name','last_name','phone_number','email_id','address','country','city','state','pincode','user_id']));

        return view('front.HomePage.payment');
    }

    public function update(CheckOutRequest $request){

        $data = $request->all();

        Address::find($request->id)->update($data);

        return view('front.HomePage.checkOutPage');
    }

}
