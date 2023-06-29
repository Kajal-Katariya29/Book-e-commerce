@extends('admin.app')

@section('tiitle')

@endsection

@section('body')
    @include('front.HomePage.navbaar')
    <div class="container">
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" rows="3" placeholder="Address(Area and street)"></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control" id="pincode" placeholder="Pincode">
            </div>
            <div class="mb-3 col-6">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="locality" placeholder="Locality">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control" id="pincode" placeholder="Pincode">
            </div>
            <div class="mb-3 col-6">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="locality" placeholder="Locality">
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
