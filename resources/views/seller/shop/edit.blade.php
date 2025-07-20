<x-seller.auth-layout>
    @section('title', 'Edit Shop')
    <div id="coli" class="row mb-3">
        <div class="col">
            <div class="card text-start">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col">
                            <h3>Profile Shop</h3>
                        </div>
                    </div>
                    <div class="row" id="shop">
                        <form action="{{ route('seller.shop.update', $shop->uuid) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ $shop->id }}">
                            <div class="col">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Basic Information</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Advanved
                                            Information</button>
                                    </li>
                                </ul>
                                <div class="tab-content py-3" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="shop-name">Profile Shop Picture <span
                                                    class="text-danger required">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="fileInput">
                                                    @if (request()->shop->profile_picture)
                                                        <img src="{{ url('storage/'.request()->shop->profile_picture) }}" alt="Profile Picture" class="w-25 upload-image img-fluid" id="uploadImage">
                                                    @else
                                                        <img src="https://via.placeholder.com/150" alt="Profile Picture" class="w-25 upload-image img-fluid" id="uploadImage">
                                                    @endif
                                                </label>
                                                <input type="file" class="custom-file-input" id="fileInput" style="display: none;" accept="image/png, image/gif, image/jpeg" name="shop_profile_picture" onchange="previewImage(event)">
                                            </div>
                                            <small>if you want to change your profile picture, click on the image.</small>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="shop-name">Shop Name <span
                                                    class="text-danger required">*</span></label>
                                            <input type="text" class="form-control" id="shop-name" name="shop_name"
                                                required value="{{ old('shop_name',$shop->name) }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="shop-id-card">ID Card Number<span
                                                    class="text-danger required">*</span></label>
                                            <input type="text" class="form-control" id="id-card" name="id_card"
                                                required value="{{ old('id_card',$shop->id_card) }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="shop-phone-number">Shop Phone Number <span
                                                    class="text-danger required">*</span></label>
                                            <input type="tel" class="form-control" id="shop-phone-number"
                                                name="shop_phone_number" required value="{{ old('shop_phone_number',$shop->phone_number) }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="contact-person-name">Contact Person Name<span
                                                    class="text-danger required">*</span></label>
                                            <input type="text" class="form-control" id="contact-person-name"
                                                name="contact_person_name" required value="{{ old('contact_person_name',$shop->contact_person) }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="description">Description<span
                                                    class="text-danger required">*</span></label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description',$shop->description) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="shop-address">Shop Address<span
                                                    class="text-danger required">*</span></label>
                                            <textarea class="form-control" id="shop-address" name="shop_address" rows="3" required>{{ old('shop_address',$shop->address) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">

                                        <div class="form-group mb-3">
                                            <label for="business-license">Business License</label>
                                            <input type="file" class="form-control" id="business-license"
                                                name="business_license" accept="image/png, image/gif, image/jpeg" value="{{ $shop->contact_person }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="supplier-name">Supplier Name</label>
                                            <input type="text" class="form-control" id="supplier-name"
                                                name="supplier_name" value="{{ old('supplier_name',$shop->supplier_name) }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="invitation-code">Invitation Code</label>
                                            <input type="text" class="form-control" id="invitation-code"
                                                name="invitation_code" value="{{ old('invitation_code',$shop->invitation_code) }}">
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
                                                {{-- <option value="Credit Card">Credit Card</option>
                                                <option value="Debit Card">Debit Card</option>
                                                <option value="Bank Transfer">Bank Transfer</option> --}}
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="merchant-category">Merchant Category</label>
                                            <select class="form-control" id="merchant-category"
                                                name="merchant_category">
                                                <option value="">--Select Merchant Category--</option>
                                                @foreach ($shop->merchant_category as $merchant_key => $merchant_category)
                                                    <option value="{{ $merchant_key }}" {{ ($shop->merchant_id) && ($merchant_key == $shop->merchant_id) ? 'selected' : '' }}>{{ $merchant_category }}</option>
                                                @endforeach
                                                {{-- <option value="0">All Category</option>
                                                <option value="1">Fashion</option>
                                                <option value="2">Electronics</option>
                                                <option value="3">Home & Garden</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('uploadImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

    </script>
</x-seller.auth-layout>
