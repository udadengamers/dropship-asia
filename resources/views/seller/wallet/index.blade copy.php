<x-seller.auth-layout>
    @push('after-styles')
        <link rel="stylesheet" href="{{ mix('css/wallet.css') }}">
        <style>
            #shop .navbar .navbar-nav .nav-link {
                color: rgb(52, 52, 52)!important;
            }
            #shop .navbar {
                box-shadow: none !important;
            }
            #shop .navbar .nav-link.active {
                display: inline-block;
                position: relative;
                background: none;
                color: #f53d2d !important;
            }
        </style>
    @endpush
    @section('title', 'Wallet')
    
    <div class="row g-6 mb-4">
        <div class="col-xl-12 col-12">
            <div class="card border-0">
                <div class="card-body">
                    @include('seller.wallet.parts.wallet')
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        @include('seller.wallet.parts.topup_withdraw')
    </div>

    <div class="row g-6 mb-4">
        <div class="col-xl-12 col-12 mb-4">
            <div class="card border-0">
                <div class="card-body">
                    @include('seller.wallet.parts.list')
                </div>
            </div>
        </div>
    </div>
</x-seller.auth-layout>