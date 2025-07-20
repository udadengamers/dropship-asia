<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Seller Information</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Shop Information</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active py-3" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <input type="hidden" name="id" value="{{ old('id', $seller->id) }}">
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">First Name
                        <span class="text-danger required">*</span>
                    </label>
                    <input type="text" class="form-control" name="fname" id="fname" aria-describedby="fnameHelpId" value="{{ old('fname', $seller->fname) }}" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Last Name
                        <span class="text-danger required">*</span>
                    </label>
                    <input type="text" class="form-control" name="lname" id="lname" aria-describedby="lnameHelpId" value="{{ old('lname', $seller->lname) }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Email
                        <span class="text-danger required">*</span>
                    </label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" value="{{ old('email', $seller->email) }}" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Phone Number
                        <span class="text-danger required">*</span>
                    </label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone_numberHelpId" value="{{ old('phone', $seller->phone) }}" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Date Of Birth
                <span class="text-danger required">*</span>
            </label>
            <input type="wallet_address" class="form-control datepicker" name="date_of_birth" id="date_of_birth" aria-describedby="date_of_birthHelpId" value="{{ old('date_of_birth', $seller->buyer_detail ? $seller->buyer_detail->date_of_birth : '' ) }}" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Password
                <span class="text-danger required">*</span>
            </label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelpId" {{ $seller->password ? '' : 'required'}}>
            @if ($seller->password)
                <small>Leave password field blank if remain unchanged</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Wallet Address
                <span class="text-danger required">*</span>
            </label>
            <input type="wallet_address" class="form-control" name="wallet_address" id="wallet_address" aria-describedby="wallet_addressHelpId" value="{{ old('wallet_address', $seller->wallet_address ?? Str::random(60, 'alnum')) }}" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">State
                <span class="text-danger required">*</span>
            </label>
            <div class="form-check">
                <input class="form-check-input" name="state" value="active" type="radio" name="flexRadioDefault" id="flexRadioDefault1"  {{ old('status', $seller->state) == 'active' ? 'checked' : '' }} required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="state" value="inactive" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{ old('status', $seller->state) == 'inactive' ? 'checked' : '' }} required>
                <label class="form-check-label" for="flexRadioDefault2">
                    Inactive
                </label>
            </div>
        </div>        
        <div class="mb-3">
          <label for="" class="form-label">Address One
            <span class="text-danger required">*</span>
        </label>
          <textarea class="form-control" name="address_one" id="address_one" rows="3">{!! old('address_one', $seller->buyer_detail ? $seller->buyer_detail->address_one : '') !!}</textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Address Two
            <span class="text-danger required">*</span>
        </label>
          <textarea class="form-control" name="address_two" id="address_two" rows="3">{!! old('address_two', $seller->buyer_detail ? $seller->buyer_detail->address_two : '') !!}</textarea>
        </div>
    </div>
    <div class="tab-pane fade py-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @php $shop = $seller->shop ?? new App\Models\Shop() @endphp
        <div class="form-group mb-3">
            <label for="shop-name">Shop Name <span
                    class="text-danger required">*</span></label>
            <input type="text" class="form-control" id="shop-name" name="shop_name"
                required value="{{ old('shop_name', $shop->name) }}">
        </div>
        <div class="form-group mb-3">
            <label for="shop-id-card">ID Card Number<span
                    class="text-danger required">*</span></label>
            <input type="text" class="form-control" id="id-card" name="id_card"
                required value="{{ old('id_card', $shop->id_card) }}">
        </div>
        <div class="form-group mb-3">
            <label for="shop-phone-number">Shop Phone Number <span
                    class="text-danger required">*</span></label>
            <input type="tel" class="form-control" id="shop-phone-number"
                name="shop_phone_number" required value="{{ old('shop_phone_number', $shop->phone_number) }}">
        </div>
        <div class="form-group mb-3">
            <label for="contact-person-name">Contact Person Name<span
                    class="text-danger required">*</span></label>
            <input type="text" class="form-control" id="contact-person-name"
                name="contact_person_name" required value="{{ old('contact_person_name', $shop->contact_person) }}">
        </div>
        <div class="form-group mb-3">
            <label for="description">Description<span
                    class="text-danger required">*</span></label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $shop->description) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="shop-address">Shop Address<span
                    class="text-danger required">*</span></label>
            <textarea class="form-control" id="shop-address" name="shop_address" rows="3" required>{{ old('shop_address', $shop->address) }}</textarea>
        </div>
    </div>
</div>