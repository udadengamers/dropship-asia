<x-seller.auth-layout>
    @push('after-styles')
        <link rel="stylesheet" href="{{ mix('css/wallet.css') }}">
        <style>
            @media (max-width: 767.98px) {
                .container {
                    max-width: 100%!important;
                    padding: 0px;
                }
                /* .row > * {
                    padding: 0px;
                }
    
                .row {
                    margin-right: 0px;
                } */
            }
        </style>
    @endpush
    @section('title', 'Wallet Address')
    {{-- <div class="my-ignored-div d-md-none" style="margin-top: -3rem;"></div> --}}
    <form action="{{ route('seller.wallet.store') }}" method="post">
        @csrf
        <div class="card text-start">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Wallet Address</label>
                    <textarea class="form-control" name="wallet_address" id="wallet_address" cols="30" rows="3">{{ old('wallet_address', auth()->user()->wallet_address) }}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary-default w-100 mt-3">
            Update
        </button>
    </form>
</x-seller.auth-layout>
