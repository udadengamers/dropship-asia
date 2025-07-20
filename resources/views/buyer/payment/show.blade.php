@extends('layouts.main')
@section('bodyDR')
<div class="account-container">
    <div class="payment-body pt-4 pb-5">
        <div class="container  mb-5" style="padding:0 10% 0 10% ;">
            <div class="row justify-content-center align-items-center g-2" style="background-color:white;box-shadow: 2px 2px 5px rgba(250, 56, 3, 0.807);border-radius:5px;">
                <div class="title-payment-form" style="width: 100%;text-align:center;padding:20px 0 10px 0 ;">
                    <h3 class="p-0 m-0">Payment Form</h3>
                </div>
                <div class="col">
                    <form action="{{ route('payment.update', $order->uuid) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
            
                        <div class="form-group">
                            <label for="amount_submitted_label">Amount</label>
                            <input type="number" class="form-control" value="{{ old('amount_submitted', $order->total) }}" readonly id="amount_submitted" name="amount_submitted" step="any">
                        </div>
                        <div class="form-group">
                            <label for="bank_name_label">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" value="{{ old('bank_name') }}" name="bank_name" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_name_label">Account Name</label>
                            <input type="text" class="form-control" id="bank_account_name" value="{{ old('bank_account_name') }}" name="bank_account_name" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_number_label">Account Number</label>
                            <input type="text" class="form-control" id="bank_account_number" value="{{ old('bank_account_number') }}" name="bank_account_number" required>
                        </div>
                        <div class="form-group">
                            <label for="remarks_label">Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks">{{ old('remarks') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="remarks_label">Receipt</label>
                            <input type="file" name="proof_file_path" id="proof_file_path">
                        </div>
                        <button type="submit" class="btn mb-5" style="background-color: orangered;color:white;">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection