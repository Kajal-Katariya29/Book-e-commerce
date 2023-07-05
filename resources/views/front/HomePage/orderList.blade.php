@extends('admin.app')

@section('title')
    Order Listing
@endsection

@section('body')
@include('front.HomePage.navbaar')
    <div class="container pt-5">
        <div class="row p-5">
            <div class="d-flex flex-column bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    @foreach ($orders as $order)
                        <div class="d-flex flex-column bd-highlight p-5 border">
                            <h4> Order Number = {{ $order->order_id }}</h4>
                            <div class="p-2 bd-highlight">
                                Name : {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </div>

                            <div class="p-2 bd-highlight">
                                {{ $order->total_amount }}
                            </div>
                            <div class="p-2 bd-highlight">
                               <a class="btn btn-warning w-25" href="{{ route('order.detail',$order->order_id) }}" > View Details </a>
                            </div>
                            <form action="{{ route('payment.view',$order->order_id) }}" class="p-2" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning w-25"> Pay </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

@endsection
