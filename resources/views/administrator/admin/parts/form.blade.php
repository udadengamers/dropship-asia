<div class="mb-3">
    <label for="" class="form-label">Name
        <span class="text-danger required">*</span>
    </label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelpId" value="{{ old('name', $admin->name) }}" required>
</div>
<div class="mb-3">
    <label for="" class="form-label">Email
        <span class="text-danger required">*</span>
    </label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" value="{{ old('name', $admin->email) }}" required>
</div>
<div class="mb-3">
    <label for="" class="form-label">Password
        <span class="text-danger required">*</span>
    </label>
    <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelpId" {{ $admin->password ? '' : 'required'}}>
    @if ($admin->password)
        <small>Leave password field blank if remain unchanged</small>
    @endif
</div>
<div class="mb-3">
    <label for="" class="form-label">Wallet Address
        <span class="text-danger required">*</span>
    </label>
    <input type="wallet_address" class="form-control" name="wallet_address" id="wallet_address" aria-describedby="wallet_addressHelpId" value="{{ old('wallet_address', $admin->wallet_address ?? Str::random(60, 'alnum')) }}" required>
</div>
<div class="mb-3">
    <label for="" class="form-label">State
        <span class="text-danger required">*</span>
    </label>
    <div class="form-check">
        <input class="form-check-input" name="state" value="active" type="radio" name="flexRadioDefault" id="flexRadioDefault1"  {{ old('status', $admin->state) == 'active' ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" name="state" value="inactive" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{ old('status', $admin->state) == 'inactive' ? 'checked' : '' }}>
        <label class="form-check-label" for="flexRadioDefault2">
            Inactive
        </label>
    </div>
</div>