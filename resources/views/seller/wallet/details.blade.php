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
            #shop .navbar .navbar-nav .nav-link {
                color: rgb(52, 52, 52)!important;
            }
            #shop li {
                white-space: nowrap;
            }
            #shop ul {
                padding-bottom: 5px;
            }
            #shop .navbar .nav-link.active {
                display: inline-block;
                position: relative;
                background: none;
                color: #f53d2d;
            }
    
            #shop .navbar .nav-link.active::after {
                content: "";
                display: block;
                width: 100%;
                border-bottom: 3px solid #f53d2d;
                position: absolute;
                left: 0;
                bottom: -0.2em;
            }
        </style>
    @endpush
    @section('title', $title)
    <div class="my-ignored-div d-md-none" style="margin-top: -3rem;"></div>
    @if (isset($wallets))
        @include('seller.wallet.parts.wallet.index')
    @elseif(isset($topups))
        @include('seller.wallet.parts.topup.index')
    @else
        @include('seller.wallet.parts.withdraw.index')
    @endif
</x-seller.auth-layout>
