@extends('layouts.main')
@section('bodyDR')

    <div class="row index-wallet-body" style="">
        <div class="col p-0">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-center align-items-center">
                        <span class="d-flex align-items-center">
                            <a href="/account">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </span>            
                        <p class="pt-0 mt-0 align-self-center">
                            <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Account</h4>
                        </p>
                    </div>
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
                <a href="{{ route('topup-select', ['back' => url()->previous()]) }}"
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
                <a href="{{ route('billing', ['back' => url()->previous()]) }}"
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
                <a href="{{ route('topup-record', ['back' => url()->previous()]) }}"
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
                <a href="{{ route('wallet-address', ['back' => url()->previous()]) }}"
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
        </div>
    </div>
@endsection