<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CartList;
use App\Models\BookList;
use App\Models\VariantType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartLists = CartList::with('books.bookMedia','variants','user')->where('user_id',Auth::user()->user_id)->get();
        return view('front.HomePage.cartList',compact('cartLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartQuantity = CartList::where('book_id', $request->book_id)->where('user_id', $request->user_id)->where('variant_type_id',$request->variant_type_id)->first();

        if(empty($cartQuantity)){
            $cartData = CartList::create($request->only(['user_id','book_id','variant_type_id','book_price','quantity']));
        }
        else{
            $cartQuantity->quantity =  $cartQuantity->quantity + 1;
            $cartQuantity->save();
        }

        return response()->json(['success' => true, ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cartData = CartList::where('cart_list_id',$id)->update($request->only(['quantity']));
        return response()->json(['success' => true, ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartData = CartList::where('cart_list_id',$id)->delete();

    }
}

