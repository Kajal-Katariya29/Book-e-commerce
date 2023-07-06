@extends('admin.app')

@section('title')
    Place Order
@endsection

@section('body')
    @include('front.HomePage.navbaar')

    <div class="container">
        @php
            $totalAmount = 0;
        @endphp
        <div class="row pt-5">
            <div class="col-md-6 border">
                <h3>Shipping Address Information </h3>
                <input type="hidden" name="address_id" value="{{ $addressdata->address_id }}" class="addressId">
                <div class="d-flex flex-column pt-2">
                    <div class="p-2">
                        Name : {{ $addressdata->first_name }} {{ $addressdata->last_name }}
                    </div>
                    <div class="p-2">
                        Phone Number : {{ $addressdata->phone_number }}
                    </div>
                    <div class="p-2">
                        Address : {{ $addressdata->address }}
                    </div>
                    <div class="p-2">
                        Country : {{ $addressdata->country }}
                    </div>
                    <div class="p-2">
                        State : {{ $addressdata->state }}
                    </div>
                    <div class="p-2">
                        City : {{ $addressdata->city }}
                    </div>
                    <div class="p-2">
                        Pincode : {{ $addressdata->pincode }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 border">
                <h3> Order Information</h3>
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <td scope="col"> Product_name</td>
                            <td scope="col"> Language </td>
                            <td scope="col"> Quantity  </td>
                            <td scope="col"> Price </td>
                            <td scope="col"> Total Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartlists as $cart)
                            <tr>
                                @foreach ($cart->books as $book)
                                    <td value={{ $book->book_id }}>{{ $book->name }}</td>
                                @endforeach
                                @foreach ($cart->variants as $variant)
                                    <td value={{ $variant->variant_type_id }}> {{ $variant->variant_type_name }} </td>
                                @endforeach
                                <td>{{ $cart->quantity  }}</td>
                                <td>{{ $cart->book_price }}</td>
                                <td> {{ $cart->book_price * $cart->quantity }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($cartlists as $cart)
                    @php
                        $totalAmount += ($cart->book_price * $cart->quantity);
                    @endphp
                @endforeach
                <h4 class="border p-5">
                    Total Amount : <p class="totalAmount"> {{ $totalAmount }} </p>
                </h4>
            </div>
        </div>
        <div class="form-check mb-3 col-12 ms-2 pt-4">
            <input type="checkbox" class="form-check-input" id="differentAddress">
            <label class="form-check-label" for="differentAddress">
                If your Billing Address and Shipping Address are Different !!
            </label>
        </div>
        <div class="addressContainer">
            <div class="row pt-3">
                <div class="col-md-6">
                    <label for="billingAddress" class="form-label">Choose your Billing address : </label>
                    <select id="billingAddress" class="form-select billingAddress" name="billing_address_id" required>
                        <option value="">Select address</option>
                        @foreach ($addresses as $address)
                            <option
                                value="{{ $address->address_id }}">
                                {{ $address->address }} , {{ $address->country }} , {{ $address->state }} , {{ $address->city }} , {{ $address->pincode }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <h4> Payment Method </h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentType" id="stripe" value="stripe">
                <label class="form-check-label" for="cod">
                     Stripe
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentType" id="cod" value="cod">
                <label class="form-check-label" for="Stripe">
                    COD
                </label>
            </div>
        </div>
        <div class="pt-3">
            <button class="btn btn-warning w-25 placeOrder">
                Check Out
            </button>
        </div>
    </div>
@endsection

@section('scripts')

<script>
   $(document).ready(function() {

        $(".addressContainer").hide();

        $("#differentAddress").change(function() {
            if ($(this).is(":checked")) {
            $(".addressContainer").show();
            } else {
            $(".addressContainer").hide();
            }
        });


        $('.placeOrder').on("click",function(){
            var shippping_address_id = $('.addressId').val();
            var billing_address_id = $('.billingAddress').val();
            var total_amount = $('.totalAmount').text();
            var payment_type = $("input[name='paymentType']:checked").val();
            var routeUrl = "/place-order-store";
            var cartLists = [];

            $('table tbody tr').each(function(){
                var productName = $(this).find('td:nth-child(1)').attr('value');
                var quantity = $(this).find('td:nth-child(3)').text();
                var price = $(this).find('td:nth-child(5)').text();
                var variant = $(this).find('td:nth-child(2)').attr('value');

                cartLists.push({
                    product_name: productName,
                    quantity: quantity,
                    price: price,
                    variant: variant
                });
            });

            $.ajax({
            url: routeUrl,
            type: "post",
                data: {
                    shippping_address_id: shippping_address_id,
                    billing_address_id: billing_address_id,
                    total_amount: total_amount,
                    payment_type: payment_type,
                    cartLists: cartLists,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.redirectUrl){
                        window.location.href = response.redirectUrl;
                    }
                    else{
                        window.location.href = response.url;
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        });
    });

</script>

@endsection
