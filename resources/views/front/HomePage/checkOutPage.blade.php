@extends('admin.app')

@section('tiitle')

@endsection

@section('body')
    @include('front.HomePage.navbaar')
    <div class="container">
        <h1 class="pt-2">Check Out</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @php
            $totalAmount = 0;
        @endphp

        @php
            $data= $addressdata->toArray();
        @endphp

        <div class="row">
            <div class="col-md-9">
                <div class="row pt-2">
                    @foreach ($addressdata as $index => $address)
                        <div class="d-flex flex-row bd-highlight mb-3 border">
                            <div class="p-1 bd-highlight">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="defaultAddress" id="flexRadioDefault1"
                                    {{ $index === 0 ? 'checked' : '' }} value="{{ $address->address_id }}">
                                    <label class="form-check-label" for="flexRadioDefault1">

                                    </label>
                                </div>
                            </div>
                            <div class="bd-highlight">
                                <div class="d-flex flex-column bd-highlight mb-3">
                                    <div class="p-1 bd-highlight">
                                        {{ $address->address }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        {{ $address->country }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        {{ $address->state }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        {{ $address->city }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        {{ $address->pincode }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        Phone : {{ $address->phone_number }}
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <button class="btn btn-secondary editAddress" data-address-id="{{ $address->address_id }}"> Edit this Address </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex flex-row bd-highlight mb-3">
                    @if($addressdata->isNotEmpty())
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-warning addAddress" >
                                Add new Address
                            </button>
                        </div>
                    @endif
                    @if ($addressdata->isNotEmpty())
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-warning useAddress">
                                Use this address
                            </button>
                        </div>
                    @endif
                </div>
                <div id="addressForm">
                    <form action="{{ route('checkOut.store') }}" method="post" class="form">
                        @csrf
                        <input type="hidden" name="id" id="updateAddress" value="">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                        <div class="row pt-3 g-2">
                            <div class="mb-3 col-6">
                                <label for="firstname" class="form-label">First Name : </label>
                                <input type="text" class="form-control" id="firstname" placeholder="Fisrt Name"  name="first_name" value="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="lastname" class="form-label">Last Name : </label>
                                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="last_name" value="" >
                            </div>
                            <div class="mb-3 col-6">
                                <label for="phonenumber" class="form-label">Phone Number : </label>
                                <input type="text" class="form-control" id="phonenumber" placeholder="Phone Number" name="phone_number" value="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="emailId" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email_id" aria-describedby="emailHelp" name="email_id" placeholder="Email" value="">
                                </div>
                            <div class="mb-3 col-12 pt-3">
                                <label for="address" class="form-label">Address : </label>
                                <textarea class="form-control" id="address" rows="3" placeholder="Address(Area and street)" name="address" placeholder="Address(Area and street)">
                                    {{ !empty($addressData) ? $addressData->shipping_address : '' }}
                                </textarea>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="country" class="form-label">Country : </label>
                                <input type="text" class="form-control" id="country" placeholder="Country" name="country"  value="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="state" class="form-label">State : </label>
                                <input type="text" class="form-control" id="state" placeholder="State" name="state"  value="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="city" class="form-label">City : </label>
                                <input type="text" class="form-control" id="city" placeholder="City" name="city"  value="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="pincode" class="form-label">Pincode : </label>
                                <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode"  value="">
                            </div>
                            <button type="submit" class="btn btn-warning w-25"> Use this address </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3 p-5">
                @foreach ($carts as $cart)
                    @php
                        $totalAmount += ($cart->book_price * $cart->quantity);
                    @endphp
                @endforeach
                <p class="border p-5">
                    Total Amount : {{ $totalAmount }}
                </p>
            </div>
        </div>
        <div class="addForm">

        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function() {

            var count = {!! count($data) !!};
            console.log(count);

            var form = document.getElementById('addressForm');
            if (count > 0) {
                form.style.display = 'none';
            } else {
                form.style.display = 'block';
            }

            $('.addAddress').on("click",function() {
                console.log("here");
                form.style.display = 'block';
            });

            $('.editAddress').on("click",function(){
                form.style.display = 'block';
                var addressId = $(this).attr('data-address-id');
                var routeUrl = "/check-out-edit/" + addressId;

                $.ajax({
                url: routeUrl,
                type: "get",
                    data: {
                        addressId: addressId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.addressForm').css('display','block');
                        var addressData = response.addressData;
                        if (addressData) {
                            $('#updateAddress').val(addressData.address_id);
                            $('#firstname').val(addressData.first_name);
                            $('#lastname').val(addressData.last_name);
                            $('#phonenumber').val(addressData.phone_number);
                            $('#email_id').val(addressData.email_id);
                            $('#address').val(addressData.address);
                            $('#country').val(addressData.country);
                            $('#state').val(addressData.state);
                            $('#city').val(addressData.city);
                            $('#pincode').val(addressData.pincode);
                            $(".form").attr('action', "{{ route('checkOut.update', '') }}");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(textStatus);
                    }
                });
            });

            $('.useAddress').on("click",function(){
                console.log("here");
                var address_id = $("input[name='defaultAddress']:checked").val();
                var routeUrl = "/deliever-address";
                $.ajax({
                    url: routeUrl,
                    type: "get",
                        data: {
                            address_id: address_id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            window.location.href = "/place-order/" + address_id;
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(textStatus);
                        }
                    });
            });
        });
    </script>
@endsection

