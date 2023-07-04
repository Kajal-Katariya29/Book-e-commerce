@extends('admin.app')

@section('title')
    Order Detail Page
@endsection

@section('body')
    @include('front.HomePage.navbaar')

    <div class="conatiner p-5">
        <div class="row p-5">
            @foreach ($orderItems as $items)
                <div class="d-flex flex-row bd-highlight mb-3 border-bottom">
                    <div class="p-2 bd-highlight">
                        <img src="{{ asset('images/Book-Images/' . $items->book->bookMedia[0]->book_id . '/' . $items->book->bookMedia[0]->media_name) }}" alt="" width="150" height="150">
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="d-flex flex-column bd-highlight mb-3">
                            <div class="p-2 bd-highlight">
                                Product Name : {{ $items->book->name }}
                            </div>
                            <div class="p-2 bd-highlight">
                                Quantity :  {{ $items->quantity }}
                            </div>
                            <div class="p-2 bd-highlight">
                                Language :  {{ $items->varianttype->variant_type_name }}
                            </div>
                            <div class="p-2 bd-highlight">
                                Price : {{ $items->price }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex flex-column bd-highlight">
                <div class="p-2 bd-highlight">
                    Payment Type : {{ $order->payment_type }}
                </div>
                <div class="p-2 bd-highlight">
                    Payment Status : {{ $order->payment_status }}
                </div>
                <div class="p-2 bd-highlight">
                    @foreach ($order->billingAddress as $address)
                        Billing Address : {{ $address->address }}, {{ $address->country }}, {{ $address->city }}, {{ $address->state }} ,{{ $address->pincode }}
                    @endforeach
                </div>
                <div class="p-2 bd-highlight">
                    @foreach ($order->shippingAddress as $address)
                        Shipping Address : {{ $address->address }}, {{ $address->country }}, {{ $address->city }}, {{ $address->state }} ,{{ $address->pincode }}
                    @endforeach
                </div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('order.view') }}" class="btn btn-secondary"> Back to Order list</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
