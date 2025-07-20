<x-seller.auth-layout>
    @section('title', 'Create Shop')
    <div class="row">
        <div class="col-5 mx-auto">
            <form action="{{ route('seller.shop.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="business-license">Business License</label>
                    <input type="file" class="form-control" id="business-license" name="business_license" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="form-group mb-3">
                    <label for="shop-name">Shop Name <span class="text-danger required">*</span></label>
                    <input type="text" class="form-control" id="shop-name" name="shop_name" value="{{ old('shop_name',$shop->name) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="shop-profile-picture">Shop Profile Picture <span class="text-danger required">*</span></label>
                    <input type="file" class="form-control" id="shop-profile-picture" accept="image/png, image/gif, image/jpeg" name="shop_profile_picture"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="shop-id-card">ID Card Number<span class="text-danger required">*</span></label>
                    <input type="text" class="form-control" id="id-card" name="id_card" value="{{ old('id_card') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="shop-phone-number">Shop Phone Number <span class="text-danger required">*</span></label>
                    <input type="tel" class="form-control" id="shop-phone-number" name="shop_phone_number" value="{{ old('shop_phone_number') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="contact-person-name">Contact Person Name<span class="text-danger required">*</span></label>
                    <input type="text" class="form-control" id="contact-person-name" name="contact_person_name" value="{{ old('contact_person_name') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="supplier-name">Supplier Name</label>
                    <input type="text" class="form-control" id="supplier-name" value="{{ old('supplier_name') }}" name="supplier_name">
                </div>
                <div class="form-group mb-3">
                    <label for="invitation-code">Invitation Code</label>
                    <input type="text" class="form-control" id="invitation-code" value="{{ old('invitation_code') }}" name="invitation_code">
                </div>
                <div class="form-group mb-3">
                    <label for="payment-method">Payment Method</label>
                    <select class="form-control" id="payment-method" name="payment_method">
                        <option value="">--Select Payment Method--</option>
                        @if (count($shop->payment_method) == 1)
                            @foreach ($shop->payment_method as $key => $payment_method)
                                <option value="{{ $key }}" {{ $key == $shop->payment_method_id ? 'selected' : 'selected' }}>{{ $payment_method }}</option>
                            @endforeach
                        @else
                            @foreach ($shop->payment_method as $key => $payment_method)
                                <option value="{{ $key }}" {{ $key == $shop->payment_method_id ? 'selected' : '' }}>{{ $payment_method }}</option>
                            @endforeach
                        @endif
                        {{-- <option value="1">Credit Card</option>
                        <option value="2">Debit Card</option>
                        <option value="3">Bank Transfer</option> --}}
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="merchant-category">Merchant Category</label>
                    <select class="form-control" id="merchant-category" name="merchant_category">
                        <option value="">--Select Merchant Category--</option>
                        @foreach ($shop->merchant_category as $merchant_key => $merchant_category)
                            <option value="{{ $merchant_key }}" {{ ($shop->merchant_id) && ($merchant_key == $shop->merchant_id) ? 'selected' : '' }}>{{ $merchant_category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="shop-address">Shop Address<span class="text-danger required">*</span></label>
                    <textarea class="form-control" id="shop-address" name="shop_address" rows="3" required>{{ old('shop_address') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-seller.auth-layout>
