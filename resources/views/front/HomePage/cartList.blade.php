@extends('admin.app')

@section('title')
    Add To Cart Page
@endsection

@section('body')

@include('front.HomePage.navbaar')
<div class="container pt-5">
    <h3>Cart List</h3>
    @php
        $totalAmount = 0;
    @endphp
    @foreach ($cartLists as $cartlist)
        <div class="row pt-3">
            {{-- <input type="hidden" name="id" value="{{ $cartlist->cart_list_id}}" class="cartId"> --}}
            @foreach ($cartlist->books as $book)
                <div class="col-md-3">
                    <img src="{{ asset('images/Book-Images/' . $book->bookMedia[0]->book_id . '/' . $book->bookMedia[0]->media_name) }}" alt="" width="150" height="150">
                </div>
            @endforeach
            <div class="col-md-6">
                <div class="d-flex flex-column bd-highlight mb-3">
                    @foreach ($cartlist->books as $book)
                    <div class="p-2 bd-highlight">
                        {{ $book->name }}
                    </div>
                    @endforeach
                    @foreach ($cartlist->variants as $variant)
                        <div class="p-2 bd-highlight">
                            Language : {{ $variant->variant_type_name }}
                        </div>
                    @endforeach
                    <div class=" bd-highlight">
                        <div class="d-flex flex-row bd-highlight">
                            <div class="p-2 bd-highlight">
                                Quantity :  <input type="number" name="quantity" value="{{ $cartlist->quantity }}" min="1" class="quantity_{{ $cartlist->cart_list_id }}">
                            </div>
                            <div class="p-2 bd-highlight">
                                <button class="btn btn-success updateQuanity" data-cart-list-id="{{ $cartlist->cart_list_id}}"> Update Quantity</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        Price : {{ $cartlist->book_price * $cartlist->quantity }}
                    </div>
                    @php
                        $totalAmount += ($cartlist->book_price * $cartlist->quantity);
                    @endphp
                    <div class="p-2 bd-highlight">
                        <button class="btn btn-secondary removeItem" data-cartList-id="{{ $cartlist->cart_list_id}}"> Remove item </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row pt-5">
        <div class="col-md-3 border">
            <div class="d-flex flex-column bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    Total Amount : {{ $totalAmount }}
                </div>
                <div class="p-2 bd-highlight">
                    <a class="btn btn-warning px-5" href="{{ route('view-checkOut') }}"> Place Order </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')

<script>
    $(document).ready(function(){
        $('.updateQuanity').on("click",function(){
            var cart_list_id = $(this).attr('data-cart-list-id');
            console.log(cart_list_id);
            var quantity = $('.quantity_'+cart_list_id).val();
            console.log(quantity);
            var routeUrl = "/cart/" + cart_list_id;
             console.log(routeUrl);
            $.ajax({
                url: routeUrl,
                type: "PUT",
                data: {
                    cart_list_id: cart_list_id,
                    quantity: quantity,
                    method: "PUT",
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        });

        $('.removeItem').on("click",function(){
            var cart_list_id = $(this).attr('data-cartList-id');
            console.log(cart_list_id);
            var routeUrl = "/cart/" + cart_list_id;
            console.log(routeUrl);

            $.ajax({
                url: routeUrl,
                type: "DELETE",
                data: {
                    cart_list_id: cart_list_id,
                    method: "DELETE",
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        });
    });
</script>
@endsection
