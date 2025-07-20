<div class="row">
    <input type="hidden" name="id" value="{{ $user->id }}">
    <div class="col">
        <div class="mb-3">
            <label for="" class="form-label">First Name
                <span class="text-danger required">*</span>
            </label>
            <input type="text" class="form-control" name="fname" id="fname" aria-describedby="fnameHelpId" value="{{ old('fname', $user->fname) }}" required>
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="" class="form-label">Last Name
                <span class="text-danger required">*</span>
            </label>
            <input type="text" class="form-control" name="lname" id="lname" aria-describedby="lnameHelpId" value="{{ old('lname', $user->lname) }}" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="mb-3">
            <label for="" class="form-label">Email
                <span class="text-danger required">*</span>
            </label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" value="{{ old('email', $user->email) }}" required>
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="" class="form-label">Phone Number
                <span class="text-danger required">*</span>
            </label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone_numberHelpId" value="{{ old('phone', $user->phone) }}" required>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="" class="form-label">Date Of Birth
        <span class="text-danger required">*</span>
    </label>
    <input type="wallet_address" class="form-control datepicker" name="date_of_birth" id="date_of_birth" aria-describedby="date_of_birthHelpId" value="{{ old('date_of_birth', $user->buyer_detail ? $user->buyer_detail->date_of_birth : '' ) }}" required>
</div>
<div class="mb-3">
    <label for="" class="form-label">Password
        <span class="text-danger required">*</span>
    </label>
    <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelpId" {{ $user->password ? '' : 'required'}}>
    @if ($user->password)
        <small>Leave password field blank if remain unchanged</small>
    @endif
</div>
<div class="mb-3">
    <label for="" class="form-label">Wallet Address
        <span class="text-danger required">*</span>
    </label>
    <input type="wallet_address" class="form-control" name="wallet_address" id="wallet_address" aria-describedby="wallet_addressHelpId" value="{{ old('wallet_address', $user->wallet_address ?? Str::random(60, 'alnum')) }}" required>
</div>
<div class="mb-3">
    <label for="" class="form-label">State
        <span class="text-danger required">*</span>
    </label>
    <div class="form-check">
        <input class="form-check-input" name="state" value="active" type="radio" name="flexRadioDefault" id="flexRadioDefault1"  {{ old('status', $user->state) == 'active' ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" name="state" value="inactive" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{ old('status', $user->state) == 'inactive' ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault2">
            Inactive
        </label>
    </div>
</div>
<div class="mb-3">
  <label for="" class="form-label">Address One
        <span class="text-danger required">*</span>
    </label>
    <textarea class="form-control" name="address_one" id="address_one" rows="3">{!! old('address_one', $user->buyer_detail ? $user->buyer_detail->address_one : '') !!}</textarea>
</div>
<div class="mb-3">
    <label for="" class="form-label">Address Two
        <span class="text-danger required">*</span>
    </label>
    <textarea class="form-control" name="address_two" id="address_two" rows="3">{!! old('address_two', $user->buyer_detail ? $user->buyer_detail->address_two : '') !!}</textarea>
</div>