
<div class="row">
    <form action="{{ !empty($addressData) ? route('checkOut.update') : route('checkOut.store') }}" method="post">
        @csrf
        <input type="hidden" name="id"  value="{{ !empty($addressData->address_id) ? $addressData->address_id : '' }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
        <div class="row pt-3 g-2">
            <div class="mb-3 col-6">
                <label for="firstname" class="form-label">First Name : </label>
                <input type="text" class="form-control" id="firstname" placeholder="Fisrt Name"  name="first_name" value="{{ !empty($addressData->first_name) ? $addressData->first_name : '' }}">
            </div>
            <div class="mb-3 col-6">
                <label for="lastname" class="form-label">Last Name : </label>
                <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="last_name" value="{{ !empty($addressData->last_name) ? $addressData->last_name : '' }}" >
            </div>
            <div class="mb-3 col-6">
                <label for="phonenumber" class="form-label">Phone Number : </label>
                <input type="text" class="form-control" id="phonenumber" placeholder="Phone Number" name="phone_number" value="{{ !empty($addressData->phone_number) ? $addressData->phone_number : '' }}">
            </div>
            <div class="mb-3 col-6">
                <label for="emailId" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email_id" aria-describedby="emailHelp" name="email_id" placeholder="Email" value="{{ !empty($addressData->email_id) ? $addressData->email_id : '' }}">
                </div>
            <div class="mb-3 col-12 pt-3">
                <label for="address" class="form-label">Address : </label>
                <textarea class="form-control" id="address" rows="3" placeholder="Address(Area and street)" name="address" placeholder="Address(Area and street)">
                    {{ !empty($addressData->address) ? $addressData->address : '' }}
                </textarea>
            </div>
            <div class="mb-3 col-6">
                <label for="country" class="form-label">Country : </label>
                <input type="text" class="form-control" id="country" placeholder="Country" name="country"  value="{{ !empty($addressData->country) ? $addressData->country : '' }}">
            </div>
            <div class="mb-3 col-6">
                <label for="state" class="form-label">State : </label>
                <input type="text" class="form-control" id="state" placeholder="State" name="state"  value="{{ !empty($addressData->state) ? $addressData->state : '' }}">
            </div>
            <div class="mb-3 col-6">
                <label for="city" class="form-label">City : </label>
                <input type="text" class="form-control" id="city" placeholder="City" name="city"  value="{{ !empty($addressData->city) ? $addressData->city : '' }}">
            </div>
            <div class="mb-3 col-6">
                <label for="pincode" class="form-label">Pincode : </label>
                <input type="text" class="form-control" id="pincode" placeholder="Pincode" name="pincode"  value="{{ !empty($addressData->pincode) ? $addressData->pincode : '' }}">
            </div>
            <div class="form-check mb-3 col-12 ms-2">
                <input type="checkbox" class="form-check-input" id="differentAddress">
                <label class="form-check-label" for="differentAddress">
                    If your Billing Address and Shipping Address are Different !!
                </label>
            </div>
            <button type="submit" class="btn btn-warning w-25"> Use this address </button>
        </div>
    </form>
</div>





