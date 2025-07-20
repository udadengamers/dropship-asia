<x-seller.auth-layout>
    @section('title', 'Withdraw')
    <form action="{{ route('seller.withdraw.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3 text-start">
            <div class="card-body">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            Currency
                        </div>
                        <div class="col text-end">
                            USDT
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Chain Name</label>
                    <select class="form-select form-select" name="recharge" id="recharge">
                        @foreach (config('recharge') as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card mb-3 text-start">
            <div class="card-body">
                <div class="">
                    <label for="" class="form-label">Wallet Address</label>
                    <input type="text" name="wallet_address" id="wallet_address" class="form-control" value="{{ auth()->user()->wallet_address }}" readonly required >
                </div>
                <div class="mb-3 mt-3">
                    <label for="" class="form-label">Amount Recharge</label>
                    <div class="input-group mb-3">
                        <input type="number" name="amount_submitted" id="amount_submitted" class="form-control" required>
                        <button type="button" class="btn btn-outline-danger" id="all">all</button>
                    </div>
                </div>
                <div class="form-group text-muted">
                    available (USDT): {{ number_format(auth()->user()->balance, 2) }}
                </div>
                {{-- <div class="form-group mb-4">
                    <label for="remarks_label">Remarks</label>
                    <textarea type="text" class="form-control" id="remarks" name="remarks">{{ old('remarks') }}</textarea>
                </div> --}}
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary-default w-100" type="submit">Withdraw</button>
        </div>
    </form>

    @push('after-scripts')
        <script>
            $(document).ready(function() {
                $("#all").click(function() {
                    $("#amount_submitted").val({!! json_encode(auth()->user()->balance) !!}); // Set the value of the input field to 42
                });
            });
        </script>
    @endpush
</x-seller.auth-layout>