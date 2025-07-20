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
                color: rgb(52, 52, 52) !important;
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
    <div class="my-ignored-div d-md-none" style="margin-top: -3rem;"></div>

    <div class="card d-none d-md-block">
        <div class="card-body">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-3">
                    <h4 class="display-7 fw-bold">Current Ballance</h4>
                    <p class="col-md-8 fs-4">
                        $ {{ number_format(auth()->user()->balance, 2) }}  
                    </p>
                </div>
            </div>
        </div>   
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.topup-select', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/top-up.png" alt="">
                <span class="ml-3">Topup</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.withdraw-select', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/withdrawal.png" alt="">
                <span class="ml-3">Withdraw</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.billing', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/invoice.png" alt="">
                <span class="ml-3">Billing details</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.topup-record', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/edit.png" alt="">
                <span class="ml-3">Topup record</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.withdrawl-record', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/to-do-list.png" alt="">
                <span class="ml-3">Withdrawals record</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
    <div class="list-group rounded-0">
        <a href="{{ route('seller.wallet-address', ['back' => url()->previous()]) }}"
            class="list-group-item d-flex justify-content-between py-3 align-items-center list-group-item-action"
            aria-current="true">
            <span>
                <img class="img-fluid mr-2" src="/img/wallet.png" alt="">
                <span class="ml-3">USDT wallet</span>
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width=".9em" height=".9em" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </a>
    </div>
</x-seller.auth-layout>
